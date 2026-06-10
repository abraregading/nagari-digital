/* ============================================
   NAGARI DIGITAL SaaS — Admin Core JS
   ============================================ */

// ===== DATA PERSISTENCE =====
const DB = {
  get(key) {
    const saved = localStorage.getItem('nd_' + key);
    if (saved) return JSON.parse(saved);
    // First time: seed from NagariData
    const initial = JSON.parse(JSON.stringify(NagariData[key]));
    localStorage.setItem('nd_' + key, JSON.stringify(initial));
    return initial;
  },
  set(key, data) {
    localStorage.setItem('nd_' + key, JSON.stringify(data));
  },
  getAll() {
    const keys = ['hero','stats','products','whyChooseUs','testimonials','pricing','faq','about','messages','settings'];
    const all = {};
    keys.forEach(k => all[k] = DB.get(k));
    return all;
  }
};

// ===== GENERATE ID =====
function genId() { return Date.now() + '_' + Math.random().toString(36).substr(2,6); }

// ===== FORMAT CURRENCY =====
function formatRupiah(n) {
  return 'Rp ' + Math.floor(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// ===== TOAST NOTIFICATION =====
function toast(msg, type) {
  const existing = document.querySelector('.toast-container');
  if (!existing) {
    const c = document.createElement('div');
    c.className = 'toast-container';
    c.style.cssText = 'position:fixed;top:20px;right:20px;z-index:999;display:flex;flex-direction:column;gap:8px;';
    document.body.appendChild(c);
  }
  const container = document.querySelector('.toast-container');
  const t = document.createElement('div');
  t.style.cssText = 'padding:12px 20px;border-radius:8px;font-size:13px;font-weight:500;box-shadow:0 4px 16px rgba(0,0,0,0.12);animation:slideIn 0.3s ease;display:flex;align-items:center;gap:8px;';
  t.style.background = type === 'error' ? '#fce7f3' : type === 'warning' ? '#fef3c7' : '#dcfce7';
  t.style.color = type === 'error' ? '#9b1c1c' : type === 'warning' ? '#92400e' : '#166534';
  t.style.border = type === 'error' ? '1px solid #fbcfe8' : type === 'warning' ? '1px solid #fde68a' : '1px solid #bbf7d0';
  t.innerHTML = `<i class="fa-solid ${type === 'error' ? 'fa-circle-exclamation' : type === 'warning' ? 'fa-triangle-exclamation' : 'fa-circle-check'}"></i> ${msg}`;
  container.appendChild(t);
  setTimeout(() => { t.style.opacity = '0'; t.style.transform = 'translateX(100px)'; t.style.transition = 'all 0.3s ease'; setTimeout(() => t.remove(), 300); }, 3000);
}

// ===== CONFIRM DIALOG =====
function confirmAction(msg, cb) {
  if (confirm(msg)) cb();
}

// ===== INIT ADMIN =====
document.addEventListener('DOMContentLoaded', () => {
  const page = document.body.dataset.page;
  if (page === 'login') initLogin();
  else initAdmin(page);
});

function initLogin() {
  const form = document.getElementById('loginForm');
  const error = document.getElementById('loginError');
  form?.addEventListener('submit', (e) => {
    e.preventDefault();
    const btn = form.querySelector('.btn-login');
    btn.classList.add('loading'); btn.disabled = true;
    error.classList.remove('show');
    const u = document.getElementById('username').value;
    const p = document.getElementById('password').value;
    setTimeout(() => {
      if (u === 'admin' && p === 'admin123') {
        localStorage.setItem('nd_logged_in', 'true');
        localStorage.setItem('nd_user', JSON.stringify({ name: 'Admin Nagari', role: 'Super Admin', avatar: 'AN' }));
        window.location.href = 'dashboard.html';
      } else {
        error.textContent = 'Username atau password salah!';
        error.classList.add('show');
        btn.classList.remove('loading'); btn.disabled = false;
      }
    }, 1000);
  });
}

function initAdmin(page) {
  if (localStorage.getItem('nd_logged_in') !== 'true') {
    window.location.href = 'index.html';
    return;
  }
  renderSidebar();
  renderHeader();
  initMobileToggle();
  initModals();
  initTabs();
  initSortableTable();

  const fn = {
    dashboard: initDashboard,
    homepage: initHomepage,
    products: initProducts,
    testimonials: initTestimonials,
    pricing: initPricing,
    faq: initFaq,
    about: initAbout,
    messages: initMessages,
    settings: initSettings
  };
  if (fn[page]) fn[page]();
}

// ===== SIDEBAR =====
function renderSidebar() {
  const nav = document.getElementById('sidebarNav');
  if (!nav) return;
  const sections = [
    { title: 'Utama', links: [
      { icon: 'fa-solid fa-chart-pie', label: 'Dashboard', href: 'dashboard.html', badge: null }
    ]},
    { title: 'Konten Website', links: [
      { icon: 'fa-solid fa-house', label: 'Homepage', href: 'homepage.html', badge: null },
      { icon: 'fa-solid fa-cube', label: 'Produk / Aplikasi', href: 'products.html', badge: null },
      { icon: 'fa-solid fa-star', label: 'Testimonial', href: 'testimonials.html', badge: null },
      { icon: 'fa-solid fa-tags', label: 'Harga & Paket', href: 'pricing.html', badge: null },
      { icon: 'fa-solid fa-circle-question', label: 'FAQ', href: 'faq.html', badge: null },
      { icon: 'fa-solid fa-building-columns', label: 'Tentang Kami', href: 'about.html', badge: null }
    ]},
    { title: 'Lainnya', links: [
      { icon: 'fa-solid fa-envelope', label: 'Pesan Masuk', href: 'messages.html', badge: null },
      { icon: 'fa-solid fa-gear', label: 'Pengaturan', href: 'settings.html', badge: null },
      { icon: 'fa-solid fa-arrow-left', label: 'Ke Website', href: '../index.html', badge: null }
    ]}
  ];
  const current = window.location.pathname.split('/').pop() || 'dashboard.html';

  // Count unread messages
  const msgs = DB.get('messages');
  const unread = msgs.filter(m => !m.read).length;
  if (unread > 0) {
    sections[2].links[0].badge = { text: unread, cls: 'sidebar__link-badge--red' };
  }

  nav.innerHTML = sections.map(s => `
    <div class="sidebar__section">
      <div class="sidebar__section-title">${s.title}</div>
      ${s.links.map(l => {
        const active = l.href === current ? 'active' : '';
        const badge = l.badge ? `<span class="sidebar__link-badge ${l.badge.cls || ''}">${l.badge.text}</span>` : '';
        return `<a href="${l.href}" class="sidebar__link ${active}"><i class="${l.icon}"></i><span>${l.label}</span>${badge}</a>`;
      }).join('')}
    </div>
  `).join('');

  const user = JSON.parse(localStorage.getItem('nd_user') || '{}');
  const su = document.getElementById('sidebarUser');
  if (su) {
    su.innerHTML = `
      <div class="sidebar__user-avatar">${user.avatar || 'A'}</div>
      <div class="sidebar__user-info">
        <div class="sidebar__user-name">${user.name || 'Admin'}</div>
        <div class="sidebar__user-role">${user.role || 'Administrator'}</div>
      </div>`;
  }
}

// ===== HEADER =====
function renderHeader() {
  const c = document.getElementById('headerContent');
  if (!c) return;
  const titles = {
    dashboard: 'Dashboard', homepage: 'Homepage', products: 'Produk / Aplikasi',
    testimonials: 'Testimonial', pricing: 'Harga & Paket', faq: 'FAQ',
    about: 'Tentang Kami', messages: 'Pesan Masuk', settings: 'Pengaturan'
  };
  const page = document.body.dataset.page;
  const user = JSON.parse(localStorage.getItem('nd_user') || '{}');
  const msgs = DB.get('messages');
  const unread = msgs.filter(m => !m.read).length;
  c.innerHTML = `
    <div class="header__left">
      <button class="header__toggle" id="mobileToggle"><i class="fa-solid fa-bars"></i></button>
      <div class="header__breadcrumb">
        <a href="dashboard.html">Dashboard</a>
        <span><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current">${titles[page] || 'Dashboard'}</span>
      </div>
    </div>
    <div class="header__right">
      <button class="header__notification" onclick="window.location.href='messages.html'">
        <i class="fa-solid fa-envelope"></i>
        ${unread > 0 ? `<span class="header__notification-dot"></span>` : ''}
      </button>
      <span style="font-size:13px;color:var(--text2);font-weight:500;">${user.name || 'Admin'}</span>
    </div>`;
}

// ===== MOBILE TOGGLE =====
function initMobileToggle() {
  document.getElementById('mobileToggle')?.addEventListener('click', () => {
    document.querySelector('.sidebar')?.classList.toggle('collapsed');
  });
}

// ===== TABS =====
function initTabs() {
  document.querySelectorAll('.tabs').forEach(group => {
    group.querySelectorAll('.tab').forEach(tab => {
      tab.addEventListener('click', () => {
        const target = tab.dataset.tab;
        group.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        const parent = tab.closest('.card') || tab.parentElement;
        parent.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        const content = parent.querySelector(`#tab-${target}`);
        if (content) content.classList.add('active');
      });
    });
  });
}

// ===== MODALS =====
function initModals() {
  document.querySelectorAll('[data-modal]').forEach(btn => {
    btn.addEventListener('click', () => openModal(btn.dataset.modal));
  });
  document.querySelectorAll('.modal-overlay').forEach(m => {
    m.addEventListener('click', (e) => { if (e.target === m) closeModal(m.id); });
    m.querySelector('.modal__close')?.addEventListener('click', () => closeModal(m.id));
  });
}

function openModal(id) { const m = document.getElementById(id); if (m) m.classList.add('open'); }
function closeModal(id) { const m = document.getElementById(id); if (m) m.classList.remove('open'); }

// ===== SORTABLE TABLE ROWS =====
function initSortableTable() {
  // Could integrate SortableJS later
}

// ===== LOGOUT =====
function logout() {
  localStorage.removeItem('nd_logged_in');
  localStorage.removeItem('nd_user');
  window.location.href = 'index.html';
}

// ============ DASHBOARD ============
function initDashboard() {
  const data = DB.getAll();
  const products = data.products;
  const testimonials = data.testimonials;
  const msgs = data.messages;
  const unread = msgs.filter(m => !m.read).length;
  const stats = data.stats;

  // Update stat cards
  document.getElementById('statProducts').textContent = products.length;
  document.getElementById('statTestimonials').textContent = testimonials.length;
  document.getElementById('statMessages').textContent = msgs.length;
  document.getElementById('statUnread').textContent = unread;
  document.getElementById('statNagari').textContent = stats.find(s => s.id === 2)?.count || 50;

  // Recent messages
  const list = document.getElementById('recentMessages');
  if (list) {
    list.innerHTML = msgs.slice(0, 5).map(m => `
      <li class="activity-item">
        <div class="activity-item__icon" style="background:${m.read ? '#f3f4f6' : '#dcfce7'};color:${m.read ? '#6b7280' : '#16a34a'};">
          <i class="fa-solid ${m.read ? 'fa-envelope-open' : 'fa-envelope'}"></i>
        </div>
        <div class="activity-item__content">
          <div class="activity-item__text"><strong>${m.name}</strong> — ${m.paket || 'Konsultasi'}</div>
          <div class="activity-item__time">${m.date} • ${m.nagari}</div>
        </div>
        ${m.read ? '' : '<span class="badge badge--success">Baru</span>'}
      </li>
    `).join('');
  }

  // Chart
  const chart = document.getElementById('mainChart');
  if (chart) {
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const vals = [45,65,80,55,90,70,75,85,60,95,50,100];
    chart.innerHTML = vals.map((v,i) =>
      `<div class="chart-bar" style="background:${i < 6 ? '#0E8A4A' : '#22C55E'};height:5%;" data-height="${v}"><span class="chart-bar__label">${months[i]}</span></div>`
    ).join('');
    setTimeout(animateBars, 200);
  }
}

// ============ HOMEPAGE ============
function initHomepage() {
  const data = DB.getAll();

  // Hero
  const hero = data.hero;
  document.getElementById('heroBadge').value = hero.badge;
  document.getElementById('heroTitle').value = hero.title.replace(/<[^>]+>/g, '');
  document.getElementById('heroSubtitle').value = hero.subtitle;
  document.getElementById('heroBtnPrimary').value = hero.primaryBtn.text;
  document.getElementById('heroBtnPrimaryLink').value = hero.primaryBtn.link;
  document.getElementById('heroBtnSecondary').value = hero.secondaryBtn.text;
  document.getElementById('heroBtnSecondaryLink').value = hero.secondaryBtn.link;

  document.getElementById('heroForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const updated = {
      badge: document.getElementById('heroBadge').value,
      title: document.getElementById('heroTitle').value,
      subtitle: document.getElementById('heroSubtitle').value,
      primaryBtn: { text: document.getElementById('heroBtnPrimary').value, link: document.getElementById('heroBtnPrimaryLink').value, icon: 'fa-rocket' },
      secondaryBtn: { text: document.getElementById('heroBtnSecondary').value, link: document.getElementById('heroBtnSecondaryLink').value, icon: 'fa-eye' },
      scrollText: hero.scrollText
    };
    DB.set('hero', updated);
    toast('Hero section berhasil diperbarui!', 'success');
  });

  // Stats
  const stats = data.stats;
  const statsList = document.getElementById('statsList');
  if (statsList) {
    statsList.innerHTML = stats.map(s => `
      <tr>
        <td><i class="fa-solid ${s.icon}" style="color:#0E8A4A;"></i></td>
        <td><strong>${s.count}</strong></td>
        <td>${s.suffix}</td>
        <td>${s.label}</td>
        <td style="text-align:center;">
          <button class="btn btn--ghost btn--sm btn--icon" onclick="editStat('${s.id}')"><i class="fa-solid fa-pen"></i></button>
        </td>
      </tr>
    `).join('');
  }

  window.editStat = function(id) {
    const s = stats.find(x => x.id == id);
    if (!s) return;
    document.getElementById('statId').value = s.id;
    document.getElementById('statIcon').value = s.icon;
    document.getElementById('statCount').value = s.count;
    document.getElementById('statSuffix').value = s.suffix;
    document.getElementById('statLabel').value = s.label;
    openModal('modalEditStat');
  };

  document.getElementById('statForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const stats = DB.get('stats');
    const id = parseInt(document.getElementById('statId').value);
    const idx = stats.findIndex(s => s.id === id);
    if (idx > -1) {
      stats[idx] = { id, icon: document.getElementById('statIcon').value, count: parseFloat(document.getElementById('statCount').value), suffix: document.getElementById('statSuffix').value, label: document.getElementById('statLabel').value };
      DB.set('stats', stats);
      toast('Statistik berhasil diperbarui!', 'success');
      closeModal('modalEditStat');
      initHomepage();
    }
  });

  // Why Choose Us
  renderWhyCards();
  window.addWhy = function() {
    document.getElementById('whyId').value = '';
    document.getElementById('whyIcon').value = 'fa-gauge-high';
    document.getElementById('whyTitle').value = '';
    document.getElementById('whyDesc').value = '';
    openModal('modalEditWhy');
  };
  window.editWhy = function(id) {
    const w = data.whyChooseUs.find(x => x.id == id);
    if (!w) return;
    document.getElementById('whyId').value = w.id;
    document.getElementById('whyIcon').value = w.icon;
    document.getElementById('whyTitle').value = w.title;
    document.getElementById('whyDesc').value = w.desc;
    openModal('modalEditWhy');
  };
  window.deleteWhy = function(id) {
    confirmAction('Hapus item ini?', () => {
      let list = DB.get('whyChooseUs');
      list = list.filter(x => x.id != id);
      DB.set('whyChooseUs', list);
      toast('Item berhasil dihapus!', 'success');
      renderWhyCards();
    });
  };

  document.getElementById('whyForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    let list = DB.get('whyChooseUs');
    const id = document.getElementById('whyId').value;
    const obj = { icon: document.getElementById('whyIcon').value, title: document.getElementById('whyTitle').value, desc: document.getElementById('whyDesc').value };
    if (id) {
      const idx = list.findIndex(x => x.id == id);
      if (idx > -1) { list[idx] = { ...list[idx], ...obj }; }
    } else {
      obj.id = list.length + 1;
      list.push(obj);
    }
    DB.set('whyChooseUs', list);
    toast('Data berhasil disimpan!', 'success');
    closeModal('modalEditWhy');
    renderWhyCards();
  });
}

function renderWhyCards() {
  const list = DB.get('whyChooseUs');
  const container = document.getElementById('whyList');
  if (!container) return;
  container.innerHTML = list.map(w => `
    <div class="card" style="margin-bottom:0;">
      <div class="card__body" style="display:flex;align-items:center;gap:16px;padding:16px 20px;">
        <div style="width:44px;height:44px;background:#dcfce7;color:#16a34a;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
          <i class="fa-solid ${w.icon}"></i>
        </div>
        <div style="flex:1;">
          <strong style="font-size:14px;">${w.title}</strong>
          <p style="font-size:12px;color:var(--text2);margin:2px 0 0;">${w.desc}</p>
        </div>
        <div style="display:flex;gap:4px;">
          <button class="btn btn--ghost btn--sm btn--icon" onclick="editWhy(${w.id})"><i class="fa-solid fa-pen"></i></button>
          <button class="btn btn--ghost btn--sm btn--icon" onclick="deleteWhy(${w.id})" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></button>
        </div>
      </div>
    </div>
  `).join('');
}

// ============ PRODUCTS ============
function initProducts() {
  renderProducts();
  window.addProduct = function() {
    document.getElementById('prodId').value = '';
    document.getElementById('prodIcon').value = 'fa-file-contract';
    document.getElementById('prodTitle').value = '';
    document.getElementById('prodDesc').value = '';
    document.getElementById('prodLink').value = '';
    document.getElementById('prodColor').value = 'green';
    document.getElementById('prodFeatures').value = '';
    openModal('modalEditProduct');
  };
  window.editProduct = function(id) {
    const p = DB.get('products').find(x => x.id == id);
    if (!p) return;
    document.getElementById('prodId').value = p.id;
    document.getElementById('prodIcon').value = p.icon;
    document.getElementById('prodTitle').value = p.title;
    document.getElementById('prodDesc').value = p.desc;
    document.getElementById('prodLink').value = p.link;
    document.getElementById('prodColor').value = p.color;
    document.getElementById('prodFeatures').value = p.features.join('\n');
    openModal('modalEditProduct');
  };
  window.deleteProduct = function(id) {
    confirmAction('Hapus produk ini?', () => {
      let list = DB.get('products');
      list = list.filter(x => x.id != id);
      DB.set('products', list);
      toast('Produk berhasil dihapus!', 'success');
      renderProducts();
    });
  };

  document.getElementById('productForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    let list = DB.get('products');
    const id = document.getElementById('prodId').value;
    const features = document.getElementById('prodFeatures').value.split('\n').filter(f => f.trim());
    const obj = {
      icon: document.getElementById('prodIcon').value,
      title: document.getElementById('prodTitle').value,
      desc: document.getElementById('prodDesc').value,
      link: document.getElementById('prodLink').value,
      color: document.getElementById('prodColor').value,
      features
    };
    if (id) {
      const idx = list.findIndex(x => x.id == id);
      if (idx > -1) { list[idx] = { ...list[idx], ...obj }; }
    } else {
      obj.id = list.length > 0 ? Math.max(...list.map(x => x.id)) + 1 : 1;
      obj.order = list.length + 1;
      list.push(obj);
    }
    DB.set('products', list);
    toast('Produk berhasil disimpan!', 'success');
    closeModal('modalEditProduct');
    renderProducts();
  });
}

function renderProducts() {
  const list = DB.get('products');
  const container = document.getElementById('productList');
  if (!container) return;
  container.innerHTML = list.map(p => `
    <tr>
      <td><span class="reorder-handle"><i class="fa-solid fa-grip-vertical"></i></span></td>
      <td><div style="width:36px;height:36px;background:#dcfce7;color:#16a34a;border-radius:8px;display:flex;align-items:center;justify-content:center;"><i class="fa-solid ${p.icon}"></i></div></td>
      <td><strong>${p.title}</strong></td>
      <td>${p.features.length} fitur</td>
      <td><span class="badge badge--${p.color === 'green' ? 'success' : p.color === 'blue' ? 'info' : p.color === 'rose' ? 'danger' : 'neutral'}">${p.color}</span></td>
      <td style="text-align:center;">
        <button class="btn btn--ghost btn--sm btn--icon" onclick="editProduct(${p.id})"><i class="fa-solid fa-pen"></i></button>
        <button class="btn btn--ghost btn--sm btn--icon" onclick="deleteProduct(${p.id})" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></button>
      </td>
    </tr>
  `).join('');
}

// ============ TESTIMONIALS ============
function initTestimonials() {
  renderTestimonials();
  window.addTestimonial = function() {
    document.getElementById('testId').value = '';
    document.getElementById('testName').value = '';
    document.getElementById('testRole').value = '';
    document.getElementById('testVillage').value = '';
    document.getElementById('testText').value = '';
    document.getElementById('testRating').value = '5';
    openModal('modalEditTestimonial');
  };
  window.editTestimonial = function(id) {
    const t = DB.get('testimonials').find(x => x.id == id);
    if (!t) return;
    document.getElementById('testId').value = t.id;
    document.getElementById('testName').value = t.name;
    document.getElementById('testRole').value = t.role;
    document.getElementById('testVillage').value = t.village;
    document.getElementById('testText').value = t.text;
    document.getElementById('testRating').value = t.rating;
    openModal('modalEditTestimonial');
  };
  window.deleteTestimonial = function(id) {
    confirmAction('Hapus testimonial ini?', () => {
      let list = DB.get('testimonials');
      list = list.filter(x => x.id != id);
      DB.set('testimonials', list);
      toast('Testimonial berhasil dihapus!', 'success');
      renderTestimonials();
    });
  };

  document.getElementById('testimonialForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    let list = DB.get('testimonials');
    const id = document.getElementById('testId').value;
    const obj = {
      name: document.getElementById('testName').value,
      role: document.getElementById('testRole').value,
      village: document.getElementById('testVillage').value,
      text: document.getElementById('testText').value,
      rating: parseFloat(document.getElementById('testRating').value),
      avatar: document.getElementById('testName').value.split(' ').map(w => w[0]).join('').substr(0,2).toUpperCase()
    };
    if (id) {
      const idx = list.findIndex(x => x.id == id);
      if (idx > -1) { list[idx] = { ...list[idx], ...obj }; }
    } else {
      obj.id = list.length > 0 ? Math.max(...list.map(x => x.id)) + 1 : 1;
      list.push(obj);
    }
    DB.set('testimonials', list);
    toast('Testimonial berhasil disimpan!', 'success');
    closeModal('modalEditTestimonial');
    renderTestimonials();
  });
}

function renderTestimonials() {
  const list = DB.get('testimonials');
  const container = document.getElementById('testimonialList');
  if (!container) return;
  container.innerHTML = list.map(t => `
    <tr>
      <td><div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#0E8A4A,#22C55E);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:12px;">${t.avatar || 'NA'}</div></td>
      <td><strong>${t.name}</strong></td>
      <td>${t.role}</td>
      <td>${t.village}</td>
      <td>'${t.text.substr(0, 50)}${t.text.length > 50 ? '...' : ''}'</td>
      <td>${'★'.repeat(Math.floor(t.rating))}${t.rating % 1 ? '½' : ''}</td>
      <td style="text-align:center;">
        <button class="btn btn--ghost btn--sm btn--icon" onclick="editTestimonial(${t.id})"><i class="fa-solid fa-pen"></i></button>
        <button class="btn btn--ghost btn--sm btn--icon" onclick="deleteTestimonial(${t.id})" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></button>
      </td>
    </tr>
  `).join('');
}

// ============ PRICING ============
function initPricing() {
  const data = DB.get('pricing');

  ['dasar', 'komplet', 'lepas'].forEach(key => {
    const p = data[key];
    const el = document.getElementById(`pricingForm_${key}`);
    if (!el) return;
    document.getElementById(`${key}_name`).value = p.name;
    document.getElementById(`${key}_tagline`).value = p.tagline;
    document.getElementById(`${key}_price`).value = p.price.bulanan;
    document.getElementById(`${key}_period`).value = p.periodLabel.bulanan;
    document.getElementById(`${key}_features`).value = p.features.map(f => (f.included ? '[x]' : '[ ]') + ' ' + f.text).join('\n');

    el.addEventListener('submit', (e) => {
      e.preventDefault();
      let pricing = DB.get('pricing');
      const raw = document.getElementById(`${key}_features`).value.split('\n').filter(f => f.trim());
      const features = raw.map(f => {
        const inc = f.startsWith('[x]');
        const text = f.replace(/^\[x\]\s*|^\[ \]\s*/, '').trim();
        return { text, included: inc };
      });
      pricing[key] = {
        ...pricing[key],
        name: document.getElementById(`${key}_name`).value,
        tagline: document.getElementById(`${key}_tagline`).value,
        price: { bulanan: parseInt(document.getElementById(`${key}_price`).value) || 0, '6bulan': parseInt(document.getElementById(`${key}_price`).value) || 0, tahunan: parseInt(document.getElementById(`${key}_price`).value) || 0 },
        periodLabel: { bulanan: document.getElementById(`${key}_period`).value, '6bulan': document.getElementById(`${key}_period`).value, tahunan: document.getElementById(`${key}_period`).value },
        features
      };
      DB.set('pricing', pricing);
      toast(`Paket ${pricing[key].name} berhasil diperbarui!`, 'success');
    });
  });
}

// ============ FAQ ============
function initFaq() {
  renderFaq();
  window.addFaq = function() {
    document.getElementById('faqId').value = '';
    document.getElementById('faqIcon').value = 'fa-circle-question';
    document.getElementById('faqQuestion').value = '';
    document.getElementById('faqAnswer').value = '';
    openModal('modalEditFaq');
  };
  window.editFaq = function(id) {
    const f = DB.get('faq').find(x => x.id == id);
    if (!f) return;
    document.getElementById('faqId').value = f.id;
    document.getElementById('faqIcon').value = f.icon;
    document.getElementById('faqQuestion').value = f.question;
    document.getElementById('faqAnswer').value = f.answer.replace(/<\/?[^>]+(>|$)/g, "");
    openModal('modalEditFaq');
  };
  window.deleteFaq = function(id) {
    confirmAction('Hapus FAQ ini?', () => {
      let list = DB.get('faq');
      list = list.filter(x => x.id != id);
      DB.set('faq', list);
      toast('FAQ berhasil dihapus!', 'success');
      renderFaq();
    });
  };

  document.getElementById('faqForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    let list = DB.get('faq');
    const id = document.getElementById('faqId').value;
    const obj = {
      icon: document.getElementById('faqIcon').value,
      question: document.getElementById('faqQuestion').value,
      answer: '<p>' + document.getElementById('faqAnswer').value.replace(/\n/g, '</p><p>') + '</p>'
    };
    if (id) {
      const idx = list.findIndex(x => x.id == id);
      if (idx > -1) { list[idx] = { ...list[idx], ...obj }; }
    } else {
      obj.id = list.length > 0 ? Math.max(...list.map(x => x.id)) + 1 : 1;
      list.push(obj);
    }
    DB.set('faq', list);
    toast('FAQ berhasil disimpan!', 'success');
    closeModal('modalEditFaq');
    renderFaq();
  });
}

function renderFaq() {
  const list = DB.get('faq');
  const container = document.getElementById('faqList');
  if (!container) return;
  container.innerHTML = list.map(f => `
    <tr>
      <td><i class="fa-solid ${f.icon}" style="color:#0E8A4A;"></i></td>
      <td><strong>${f.question}</strong></td>
      <td>${f.answer.replace(/<[^>]+>/g, '').substr(0, 80)}...</td>
      <td style="text-align:center;">
        <button class="btn btn--ghost btn--sm btn--icon" onclick="editFaq(${f.id})"><i class="fa-solid fa-pen"></i></button>
        <button class="btn btn--ghost btn--sm btn--icon" onclick="deleteFaq(${f.id})" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></button>
      </td>
    </tr>
  `).join('');
}

// ============ ABOUT ============
function initAbout() {
  const data = DB.get('about');

  if (document.getElementById('aboutStory')) {
    document.getElementById('aboutStory').value = data.story.paragraphs.join('\n\n');
    document.getElementById('aboutHighlight').value = data.story.highlight;
    document.getElementById('aboutVision').value = data.vision;
    document.getElementById('aboutMissions').value = data.missions.map(m => m.text).join('\n');

    document.getElementById('aboutForm')?.addEventListener('submit', (e) => {
      e.preventDefault();
      const paragraphs = document.getElementById('aboutStory').value.split('\n\n').filter(p => p.trim());
      const missionTexts = document.getElementById('aboutMissions').value.split('\n').filter(t => t.trim());
      const icons = ['fa-laptop-code','fa-rocket','fa-database','fa-coins'];
      const updated = {
        ...data,
        story: { paragraphs, highlight: document.getElementById('aboutHighlight').value },
        vision: document.getElementById('aboutVision').value,
        missions: missionTexts.map((t, i) => ({ icon: icons[i] || 'fa-check', text: t }))
      };
      DB.set('about', updated);
      toast('Profil berhasil diperbarui!', 'success');
    });
  }

  // Values
  renderValues();
  window.addValue = function() {
    document.getElementById('valId').value = '';
    document.getElementById('valIcon').value = 'fa-lightbulb';
    document.getElementById('valTitle').value = '';
    document.getElementById('valDesc').value = '';
    openModal('modalEditValue');
  };
  window.editValue = function(id) {
    const v = data.values.find(x => x.id == id);
    if (!v) return;
    document.getElementById('valId').value = v.id;
    document.getElementById('valIcon').value = v.icon;
    document.getElementById('valTitle').value = v.title;
    document.getElementById('valDesc').value = v.desc;
    openModal('modalEditValue');
  };
  window.deleteValue = function(id) {
    confirmAction('Hapus value ini?', () => {
      let about = DB.get('about');
      about.values = about.values.filter(x => x.id != id);
      DB.set('about', about);
      toast('Value berhasil dihapus!', 'success');
      renderValues();
    });
  };

  document.getElementById('valueForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    let about = DB.get('about');
    const id = document.getElementById('valId').value;
    const obj = { icon: document.getElementById('valIcon').value, title: document.getElementById('valTitle').value, desc: document.getElementById('valDesc').value };
    if (id) {
      const idx = about.values.findIndex(x => x.id == id);
      if (idx > -1) { about.values[idx] = { ...about.values[idx], ...obj }; }
    } else {
      obj.id = about.values.length > 0 ? Math.max(...about.values.map(x => x.id)) + 1 : 1;
      about.values.push(obj);
    }
    DB.set('about', about);
    toast('Value berhasil disimpan!', 'success');
    closeModal('modalEditValue');
    renderValues();
  });

  // Timeline
  renderTimeline();
  window.editTimeline = function(idx) {
    const t = data.timeline[idx];
    document.getElementById('tlIdx').value = idx;
    document.getElementById('tlYear').value = t.year;
    document.getElementById('tlTitle').value = t.title;
    document.getElementById('tlDesc').value = t.desc;
    document.getElementById('tlStatus').value = t.status;
    openModal('modalEditTimeline');
  };

  document.getElementById('timelineForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    let about = DB.get('about');
    const idx = parseInt(document.getElementById('tlIdx').value);
    about.timeline[idx] = {
      year: document.getElementById('tlYear').value,
      title: document.getElementById('tlTitle').value,
      desc: document.getElementById('tlDesc').value,
      status: document.getElementById('tlStatus').value
    };
    DB.set('about', about);
    toast('Timeline berhasil diperbarui!', 'success');
    closeModal('modalEditTimeline');
    renderTimeline();
  });
}

function renderValues() {
  const list = DB.get('about').values;
  const container = document.getElementById('valuesList');
  if (!container) return;
  container.innerHTML = list.map(v => `
    <div class="card" style="margin-bottom:0;">
      <div class="card__body" style="display:flex;align-items:center;gap:16px;padding:16px 20px;">
        <div style="width:44px;height:44px;background:#dcfce7;color:#16a34a;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
          <i class="fa-solid ${v.icon}"></i>
        </div>
        <div style="flex:1;">
          <strong style="font-size:14px;">${v.title}</strong>
          <p style="font-size:12px;color:var(--text2);margin:2px 0 0;">${v.desc}</p>
        </div>
        <div style="display:flex;gap:4px;">
          <button class="btn btn--ghost btn--sm btn--icon" onclick="editValue(${v.id})"><i class="fa-solid fa-pen"></i></button>
          <button class="btn btn--ghost btn--sm btn--icon" onclick="deleteValue(${v.id})" style="color:#ef4444;"><i class="fa-solid fa-trash"></i></button>
        </div>
      </div>
    </div>
  `).join('');
}

function renderTimeline() {
  const list = DB.get('about').timeline;
  const container = document.getElementById('timelineList');
  if (!container) return;
  container.innerHTML = list.map((t, i) => `
    <tr>
      <td><strong>${t.year}</strong></td>
      <td><strong>${t.title}</strong></td>
      <td>${t.desc}</td>
      <td><span class="badge ${t.status === 'done' ? 'badge--success' : t.status === 'current' ? 'badge--info' : 'badge--neutral'}">${t.status}</span></td>
      <td style="text-align:center;">
        <button class="btn btn--ghost btn--sm btn--icon" onclick="editTimeline(${i})"><i class="fa-solid fa-pen"></i></button>
      </td>
    </tr>
  `).join('');
}

// ============ MESSAGES ============
function initMessages() {
  renderMessages();
}

function renderMessages() {
  const list = DB.get('messages');
  const container = document.getElementById('messagesList');
  if (!container) return;
  container.innerHTML = list.map(m => `
    <tr style="${m.read ? '' : 'background:#f0fdf4;'}">
      <td>${m.read ? '<i class="fa-solid fa-envelope-open" style="color:#9ca3af;"></i>' : '<i class="fa-solid fa-envelope" style="color:#0E8A4A;"></i>'}</td>
      <td><strong>${m.name}</strong></td>
      <td>${m.nagari}</td>
      <td>${m.whatsapp}</td>
      <td>${m.paket || '-'}</td>
      <td>${m.date}</td>
      <td style="text-align:center;">
        <button class="btn btn--ghost btn--sm btn--icon" onclick="viewMessage(${m.id})" title="Lihat"><i class="fa-solid fa-eye"></i></button>
        <button class="btn btn--ghost btn--sm btn--icon" onclick="deleteMessage(${m.id})" style="color:#ef4444;" title="Hapus"><i class="fa-solid fa-trash"></i></button>
      </td>
    </tr>
  `).join('');
}

window.viewMessage = function(id) {
  let list = DB.get('messages');
  const m = list.find(x => x.id === id);
  if (!m) return;
  if (!m.read) {
    const idx = list.findIndex(x => x.id === id);
    list[idx].read = true;
    DB.set('messages', list);
    renderMessages();
    // Update sidebar badge
    renderSidebar();
  }
  document.getElementById('modalMsgName').textContent = m.name;
  document.getElementById('modalMsgEmail').textContent = m.email || '-';
  document.getElementById('modalMsgWA').textContent = m.whatsapp;
  document.getElementById('modalMsgNagari').textContent = m.nagari;
  document.getElementById('modalMsgPaket').textContent = m.paket || 'Tidak disebutkan';
  document.getElementById('modalMsgDate').textContent = m.date;
  document.getElementById('modalMsgPesan').textContent = m.pesan;
  openModal('modalViewMessage');
};

window.deleteMessage = function(id) {
  confirmAction('Hapus pesan ini?', () => {
    let list = DB.get('messages');
    list = list.filter(x => x.id !== id);
    DB.set('messages', list);
    toast('Pesan berhasil dihapus!', 'success');
    renderMessages();
    renderSidebar();
  });
};

// ============ SETTINGS ============
function initSettings() {
  const data = DB.get('settings');

  document.getElementById('setSiteName').value = data.siteName;
  document.getElementById('setTagline').value = data.tagline;
  document.getElementById('setLogoIcon').value = data.logoIcon;
  document.getElementById('setFooterDesc').value = data.footerDesc;
  document.getElementById('setWhatsapp').value = data.whatsapp;
  document.getElementById('setEmail').value = data.email;
  document.getElementById('setLocation').value = data.location;
  document.getElementById('setFacebook').value = data.social.facebook;
  document.getElementById('setInstagram').value = data.social.instagram;
  document.getElementById('setYoutube').value = data.social.youtube;
  document.getElementById('setSeoDesc').value = data.seo.description;
  document.getElementById('setSeoKeywords').value = data.seo.keywords;
  document.getElementById('setDemoEmail').value = data.demo.email;
  document.getElementById('setDemoPassword').value = data.demo.password;
  document.getElementById('setDemoUrl').value = data.demo.demoUrl;

  document.getElementById('settingsForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const updated = {
      siteName: document.getElementById('setSiteName').value,
      tagline: document.getElementById('setTagline').value,
      logoIcon: document.getElementById('setLogoIcon').value,
      footerDesc: document.getElementById('setFooterDesc').value,
      whatsapp: document.getElementById('setWhatsapp').value,
      email: document.getElementById('setEmail').value,
      location: document.getElementById('setLocation').value,
      social: {
        facebook: document.getElementById('setFacebook').value,
        instagram: document.getElementById('setInstagram').value,
        youtube: document.getElementById('setYoutube').value
      },
      seo: {
        description: document.getElementById('setSeoDesc').value,
        keywords: document.getElementById('setSeoKeywords').value
      },
      demo: {
        email: document.getElementById('setDemoEmail').value,
        password: document.getElementById('setDemoPassword').value,
        demoUrl: document.getElementById('setDemoUrl').value
      }
    };
    DB.set('settings', updated);
    toast('Pengaturan berhasil disimpan!', 'success');
  });
}

// ===== ANIMATE BARS =====
function animateBars() {
  document.querySelectorAll('.chart-bar').forEach(bar => {
    const h = bar.dataset.height || 50;
    bar.style.transition = 'height 0.6s ease';
    bar.style.height = h + '%';
  });
}
