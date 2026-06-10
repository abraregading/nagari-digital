<div class="stats-grid">
    <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--green"><i class="fa-solid fa-cube"></i></div><span class="stat-card__trend stat-card__trend--up"><i class="fa-solid fa-arrow-up"></i> Aktif</span></div>
    <div class="stat-card__value" id="statProducts">0</div>
    <p class="stat-card__label">Produk / Aplikasi</p>
    </div>
    <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--blue"><i class="fa-solid fa-star"></i></div></div>
    <div class="stat-card__value" id="statTestimonials">0</div>
    <p class="stat-card__label">Testimonial</p>
    </div>
    <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--purple"><i class="fa-solid fa-building-columns"></i></div></div>
    <div class="stat-card__value" id="statNagari">0</div>
    <p class="stat-card__label">Nagari Terdaftar</p>
    </div>
    <div class="stat-card">
    <div class="stat-card__header"><div class="stat-card__icon stat-card__icon--amber"><i class="fa-solid fa-envelope"></i></div></div>
    <div class="stat-card__value" id="statMessages">0</div>
    <p class="stat-card__label">Total Pesan Masuk</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;">
    <div class="card">
    <div class="card__header"><h3>Grafik Pertumbuhan</h3><span style="font-size:12px;color:var(--text2);">Tahun 2026</span></div>
    <div class="card__body"><div class="chart-placeholder" id="mainChart" style="display:flex;align-items:flex-end;justify-content:space-around;height:200px;padding:20px 0;"></div></div>
    </div>
    <div class="card">
    <div class="card__header"><h3>Pesan Terbaru</h3><a href="messages.html" style="font-size:12px;color:var(--primary);text-decoration:none;">Lihat Semua</a></div>
    <div class="card__body" style="padding:8px 20px;"><ul class="activity-list" id="recentMessages"></ul></div>
    </div>
</div>

<div class="grid-4" style="margin-top:24px;">
    <div class="stat-card" style="cursor:pointer;text-align:center;padding:24px 16px;" onclick="location.href='homepage.html'">
    <div class="stat-card__icon" style="margin:0 auto 12px;background:#dcfce7;color:#16a34a;"><i class="fa-solid fa-house"></i></div>
    <h4 style="font-size:13px;font-weight:600;margin-bottom:4px;">Kelola Homepage</h4>
    <p style="font-size:11px;color:var(--text2);margin:0;">Hero, Stats, Kenapa Kami</p>
    </div>
    <div class="stat-card" style="cursor:pointer;text-align:center;padding:24px 16px;" onclick="location.href='products.html'">
    <div class="stat-card__icon" style="margin:0 auto 12px;background:#dbeafe;color:#2563eb;"><i class="fa-solid fa-cube"></i></div>
    <h4 style="font-size:13px;font-weight:600;margin-bottom:4px;">Kelola Produk</h4>
    <p style="font-size:11px;color:var(--text2);margin:0;">5 Aplikasi + Fitur</p>
    </div>
    <div class="stat-card" style="cursor:pointer;text-align:center;padding:24px 16px;" onclick="location.href='pricing.html'">
    <div class="stat-card__icon" style="margin:0 auto 12px;background:#fef3c7;color:#d97706;"><i class="fa-solid fa-tags"></i></div>
    <h4 style="font-size:13px;font-weight:600;margin-bottom:4px;">Kelola Harga</h4>
    <p style="font-size:11px;color:var(--text2);margin:0;">Paket & Perbandingan</p>
    </div>
    <div class="stat-card" style="cursor:pointer;text-align:center;padding:24px 16px;" onclick="location.href='messages.html'">
    <div class="stat-card__icon" style="margin:0 auto 12px;background:#fce7f3;color:#e11d48;"><i class="fa-solid fa-envelope"></i></div>
    <h4 style="font-size:13px;font-weight:600;margin-bottom:4px;">Pesan Masuk</h4>
    <p style="font-size:11px;color:var(--text2);margin:0;"><span id="statUnread">0</span> pesan belum dibaca</p>
    </div>
</div>