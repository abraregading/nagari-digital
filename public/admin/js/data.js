/* ============================================
   NAGARI DIGITAL SaaS — Data Store
   Semua data terstruktur, siap migrate ke DB
   ============================================ */

const NagariData = {

  // ----- HERO -----
  hero: {
    badge: 'Platform #1 Digitalisasi Nagari di Indonesia',
    title: 'Solusi Digital <span class="highlight">Terintegrasi</span> untuk Pemerintahan Nagari',
    subtitle: 'Kelola administrasi, data penduduk, pelayanan kependudukan, posyandu, dan website Nagari Anda dalam satu platform yang mudah dan modern.',
    primaryBtn: { text: 'Lihat Paket Harga', link: 'harga.html', icon: 'fa-rocket' },
    secondaryBtn: { text: 'Lihat Demo', link: 'https://kuamangalai-ug.nagaridigital.web.id/', icon: 'fa-eye' },
    scrollText: 'Scroll ke bawah'
  },

  // ----- STATS COUNTERS -----
  stats: [
    { id: 1, icon: 'fa-puzzle-piece', count: 5, suffix: '+', label: 'Aplikasi Terintegrasi' },
    { id: 2, icon: 'fa-building-columns', count: 50, suffix: '+', label: 'Nagari Terdaftar' },
    { id: 3, icon: 'fa-shield-halved', count: 99.9, suffix: '%', label: 'Uptime Terjamin' },
    { id: 4, icon: 'fa-headset', count: 24, suffix: '/7', label: 'Support Teknis' }
  ],

  // ----- PRODUCTS / APPS -----
  products: [
    {
      id: 1,
      icon: 'fa-file-contract',
      title: 'Pelayanan Kependudukan',
      desc: 'Layanan administrasi kependudukan digital untuk pembuatan Surat Keterangan, dan surat-surat penting lainnya.',
      features: ['Pembuatan surat otomatis', 'Database kependudukan', 'Tracking status pengajuan'],
      link: 'fitur.html#pelayanan',
      color: 'green',
      order: 1
    },
    {
      id: 2,
      icon: 'fa-map-location-dot',
      title: 'Aplikasi Jorong',
      desc: 'Manajemen data dan administrasi tingkat jorong yang terintegrasi dengan sistem Nagari.',
      features: ['Data jorong real-time', 'Laporan periodik otomatis', 'Sinkronisasi data Nagari'],
      link: 'fitur.html#jorong',
      color: 'blue',
      order: 2
    },
    {
      id: 3,
      icon: 'fa-users-rectangle',
      title: 'Pendataan Penduduk',
      desc: 'Sistem pencatatan dan pendataan penduduk yang akurat, lengkap, dan mudah diakses.',
      features: ['Input data terstruktur', 'Statistik demografi', 'Export laporan & grafik'],
      link: 'fitur.html#pendataan',
      color: 'purple',
      order: 3
    },
    {
      id: 4,
      icon: 'fa-heart-pulse',
      title: 'Aplikasi Posyandu',
      desc: 'Pencatatan kesehatan balita dan lansia, jadwal posyandu, dan monitoring pertumbuhan anak.',
      features: ['Kartu Menuju Sehat (KMS)', 'Jadwal imunisasi', 'Monitoring gizi balita'],
      link: 'fitur.html#posyandu',
      color: 'rose',
      order: 4
    },
    {
      id: 5,
      icon: 'fa-globe',
      title: 'Website Nagari',
      desc: 'Portal informasi resmi Nagari yang profesional dengan berita, profil, galeri, dan layanan publik.',
      features: ['Desain modern & responsif', 'CMS mudah dikelola', 'SEO optimized'],
      link: 'fitur.html#website',
      color: 'teal',
      order: 5
    }
  ],

  // ----- WHY CHOOSE US -----
  whyChooseUs: [
    { id: 1, icon: 'fa-gauge-high', title: 'Mudah Digunakan', desc: 'Interface yang intuitif dan user-friendly, tidak perlu keahlian teknis untuk mengoperasikannya.' },
    { id: 2, icon: 'fa-puzzle-piece', title: 'Terintegrasi', desc: 'Semua aplikasi saling terhubung dalam satu ekosistem, data selalu sinkron dan konsisten.' },
    { id: 3, icon: 'fa-shield-halved', title: 'Aman & Terpercaya', desc: 'Data tersimpan aman dengan enkripsi standar industri dan backup otomatis setiap hari.' },
    { id: 4, icon: 'fa-wallet', title: 'Harga Terjangkau', desc: 'Paket harga yang fleksibel dan terjangkau, mulai dari Rp 450.000/bulan untuk nagari kecil.' },
    { id: 5, icon: 'fa-headset', title: 'Support 24/7', desc: 'Tim support siap membantu kapan saja melalui WhatsApp, telepon, dan remote assistance.' },
    { id: 6, icon: 'fa-arrows-rotate', title: 'Update Berkala', desc: 'Fitur terus diperbarui mengikuti regulasi terbaru dan masukan dari pengguna.' }
  ],

  // ----- TESTIMONIALS -----
  testimonials: [
    {
      id: 1,
      name: 'Wali Nagari',
      role: 'Wali Nagari',
      village: 'Nagari Kuamang Alai Ujung Gading',
      text: 'Sejak menggunakan Nagari Digital, pelayanan administrasi di nagari kami menjadi jauh lebih cepat dan efisien. Warga sangat terbantu.',
      rating: 5,
      avatar: 'WN'
    },
    {
      id: 2,
      name: 'Sekretaris Nagari',
      role: 'Sekretaris Nagari',
      village: 'Nagari Pelangiran',
      text: 'Pendataan penduduk yang dulunya memakan waktu berhari-hari, sekarang bisa selesai dalam hitungan jam. Sangat recommended!',
      rating: 5,
      avatar: 'SK'
    },
    {
      id: 3,
      name: 'Kader Posyandu',
      role: 'Kader Posyandu',
      village: 'Nagari Sungai Aua',
      text: 'Aplikasi Posyandu sangat membantu kader dalam mencatat tumbuh kembang balita. Data jadi rapi dan bisa diakses kapan saja.',
      rating: 4.5,
      avatar: 'KP'
    }
  ],

  // ----- PRICING -----
  pricing: {
    dasar: {
      id: 'dasar',
      name: 'Paket Dasar',
      icon: 'fa-seedling',
      tagline: 'Untuk nagari yang baru memulai digitalisasi',
      price: { bulanan: 450000, '6bulan': 2250000, tahunan: 4050000 },
      periodLabel: { bulanan: '/bulan', '6bulan': '/6 bulan', tahunan: '/tahun' },
      savings: { bulanan: '', '6bulan': 'Hemat 17%', tahunan: 'Hemat 26%' },
      popular: false,
      apps: ['Pelayanan Kependudukan', 'Aplikasi Jorong'],
      features: [
        { text: 'Surat kependudukan otomatis', included: true },
        { text: 'Database penduduk dasar', included: true },
        { text: 'Dashboard jorong', included: true },
        { text: 'Laporan bulanan', included: true },
        { text: 'Support via WhatsApp', included: true },
        { text: 'Backup harian', included: true },
        { text: 'Update sistem berkala', included: true },
        { text: 'Pendataan Penduduk', included: false },
        { text: 'Aplikasi Posyandu', included: false },
        { text: 'Website Nagari', included: false },
        { text: 'Sewa server', included: false },
        { text: 'Custom domain', included: false }
      ]
    },
    komplet: {
      id: 'komplet',
      name: 'Paket Komplet',
      icon: 'fa-crown',
      tagline: 'Solusi lengkap untuk nagari yang serius berdigitalisasi',
      price: { bulanan: 9500000, '6bulan': 9500000, tahunan: 9500000 },
      periodLabel: { bulanan: '/tahun', '6bulan': '/tahun', tahunan: '/tahun' },
      savings: { bulanan: 'Termasuk server', '6bulan': 'Termasuk server', tahunan: 'Termasuk server' },
      popular: true,
      apps: ['Pelayanan Kependudukan', 'Aplikasi Jorong', 'Pendataan Penduduk', 'Aplikasi Posyandu', 'Website Nagari'],
      features: [
        { text: 'Semua fitur Paket Dasar', included: true },
        { text: 'Pendataan Penduduk lengkap', included: true },
        { text: 'Aplikasi Posyandu', included: true },
        { text: 'Website Nagari profesional', included: true },
        { text: 'Sewa server included', included: true },
        { text: 'Custom domain .nagaridigital.web.id', included: true },
        { text: 'SSL certificate gratis', included: true },
        { text: 'Priority support 24/7', included: true },
        { text: 'Training tim nagari', included: true },
        { text: 'Backup otomatis harian', included: true },
        { text: 'Update & maintenance', included: true }
      ]
    },
    lepas: {
      id: 'lepas',
      name: 'Paket Lepas',
      icon: 'fa-rocket',
      tagline: 'Beli putus, kelola sendiri sepenuhnya',
      price: { bulanan: 15000000, '6bulan': 15000000, tahunan: 15000000 },
      periodLabel: { bulanan: 'sekali bayar', '6bulan': 'sekali bayar', tahunan: 'sekali bayar' },
      savings: { bulanan: 'Full ownership', '6bulan': 'Full ownership', tahunan: 'Full ownership' },
      popular: false,
      apps: ['Pelayanan Kependudukan', 'Aplikasi Jorong', 'Pendataan Penduduk', 'Aplikasi Posyandu', 'Website Nagari'],
      features: [
        { text: 'Semua fitur Paket Komplet', included: true },
        { text: 'Source code diberikan penuh', included: true },
        { text: 'Client hosting sendiri', included: true },
        { text: 'Custom domain bebas', included: true },
        { text: 'Full ownership & hak cipta', included: true },
        { text: 'Panduan teknis lengkap', included: true },
        { text: 'Support instalasi awal', included: true },
        { text: 'Training komprehensif', included: true },
        { text: 'Bebas modifikasi', included: true },
        { text: 'Sewa server (client tanggung)', included: false },
        { text: 'Maintenance berkelanjutan', included: false }
      ]
    }
  },

  // ----- FAQ -----
  faq: [
    { id: 1, icon: 'fa-server', question: 'Apa yang termasuk dalam sewa server?', answer: '<p>Sewa server yang termasuk dalam <strong>Paket Komplet</strong> mencakup:</p><ul><li>VPS/Cloud server berkualitas tinggi</li><li>Bandwidth dan storage memadai</li><li>SSL certificate untuk keamanan</li><li>Maintenance server rutin</li><li>Monitoring uptime 24/7</li><li>Backup otomatis harian</li></ul>' },
    { id: 2, icon: 'fa-cart-shopping', question: 'Bagaimana cara berlangganan?', answer: '<p>Proses berlangganan sangat mudah:</p><ol><li>Hubungi kami via WhatsApp atau email</li><li>Pilih paket yang sesuai</li><li>Lakukan pembayaran via transfer bank</li><li>Proses setup oleh tim kami (1-3 hari)</li><li>Training penggunaan untuk tim nagari</li><li>Go live!</li></ol>' },
    { id: 3, icon: 'fa-arrow-up-right-dots', question: 'Apakah bisa upgrade paket?', answer: '<p><strong>Ya, tentu bisa!</strong> Anda dapat upgrade paket kapan saja. Biaya dihitung secara prorata berdasarkan sisa masa berlangganan.</p>' },
    { id: 4, icon: 'fa-money-bill-wave', question: 'Apakah ada biaya setup?', answer: '<p><strong>Tidak ada biaya setup!</strong> Semua biaya sudah termasuk dalam harga paket. Instalasi, import data awal, training, dan kustomisasi awal GRATIS.</p>' },
    { id: 5, icon: 'fa-right-from-bracket', question: 'Bagaimana jika ingin berhenti berlangganan?', answer: '<p>Anda bebas berhenti kapan saja tanpa penalti. Informasikan minimal 30 hari sebelumnya. Data akan kami backup dan serahkan.</p>' },
    { id: 6, icon: 'fa-shield-halved', question: 'Apakah data aman?', answer: '<p><strong>Keamanan data prioritas utama kami.</strong> Enkripsi SSL/TLS, backup harian, server terisolasi, firewall, akses role-based, dan audit log.</p>' },
    { id: 7, icon: 'fa-clock', question: 'Berapa lama proses instalasi?', answer: '<p>Paket Dasar: 1-2 hari, Paket Komplet: 3-5 hari, Paket Lepas: 5-7 hari (termasuk deployment & training).</p>' },
    { id: 8, icon: 'fa-medal', question: 'Apakah ada garansi?', answer: '<p><strong>Ya, garansi 30 hari uang kembali!</strong> Juga garansi uptime 99.9% dan garansi bug-free.</p>' }
  ],

  // ----- ABOUT -----
  about: {
    story: {
      paragraphs: [
        'Nagari Digital lahir dari keprihatinan terhadap kondisi administrasi pemerintahan nagari di Indonesia — khususnya di Sumatera Barat — yang masih sangat bergantung pada proses manual. Pencatatan data penduduk di buku tebal, pembuatan surat yang memakan waktu berjam-jam, dan arsip yang mudah rusak menjadi masalah sehari-hari.',
        'Berangkat dari pengalaman langsung, kami bertekad menciptakan solusi digital yang benar-benar sesuai dengan kebutuhan pemerintahan nagari. Bukan sekadar teknologi yang rumit dan mahal, melainkan platform yang mudah digunakan, terjangkau, dan terintegrasi penuh.',
        'Hari ini, Nagari Digital telah menjadi mitra terpercaya bagi puluhan nagari di Sumatera Barat, membantu mereka bertransformasi dari administrasi konvensional menuju tata kelola pemerintahan yang modern dan transparan.'
      ],
      highlight: 'Kami percaya bahwa setiap nagari di Indonesia berhak mendapatkan akses terhadap teknologi yang memudahkan pelayanan publik — tanpa terkecuali.'
    },
    vision: 'Menjadi platform digitalisasi pemerintahan nagari/desa terdepan di Indonesia yang menghadirkan kemudahan, efisiensi, dan transparansi dalam tata kelola pemerintahan desa untuk seluruh masyarakat Indonesia.',
    missions: [
      { icon: 'fa-laptop-code', text: 'Menyediakan teknologi yang mudah digunakan untuk pemerintahan nagari.' },
      { icon: 'fa-rocket', text: 'Meningkatkan efisiensi pelayanan publik melalui otomasi dan digitalisasi.' },
      { icon: 'fa-database', text: 'Membangun ekosistem data yang terintegrasi dan aman.' },
      { icon: 'fa-coins', text: 'Memberikan harga yang terjangkau untuk semua nagari.' }
    ],
    values: [
      { id: 1, icon: 'fa-lightbulb', title: 'Inovasi', desc: 'Terus mengembangkan fitur dan teknologi terbaru untuk memenuhi kebutuhan nagari.' },
      { id: 2, icon: 'fa-shield-halved', title: 'Integritas', desc: 'Menjaga keamanan dan privasi data pengguna sebagai prioritas utama.' },
      { id: 3, icon: 'fa-handshake', title: 'Kolaborasi', desc: 'Bekerja sama erat dengan pemerintah daerah dan stakeholder.' },
      { id: 4, icon: 'fa-wand-magic-sparkles', title: 'Kesederhanaan', desc: 'Teknologi canggih dalam antarmuka sederhana dan mudah digunakan.' },
      { id: 5, icon: 'fa-wallet', title: 'Keterjangkauan', desc: 'Harga yang bisa dijangkau semua nagari tanpa terkecuali.' },
      { id: 6, icon: 'fa-seedling', title: 'Keberlanjutan', desc: 'Komitmen jangka panjang dalam mendampingi perjalanan transformasi digital.' }
    ],
    timeline: [
      { year: '2024', title: 'Ide Awal & Pengembangan Prototype', desc: 'Riset mendalam, pengembangan konsep, dan pembuatan prototype awal aplikasi.', status: 'done' },
      { year: '2025', title: 'Peluncuran Versi Beta', desc: 'Peluncuran beta untuk nagari pertama, pengujian lapangan, dan penyempurnaan fitur.', status: 'done' },
      { year: '2026', title: 'Peluncuran Resmi — 5 Aplikasi Terintegrasi', desc: 'Platform lengkap dengan 5 aplikasi terintegrasi. Ekspansi ke lebih banyak nagari.', status: 'current' },
      { year: '2027', title: 'Target 100+ Nagari se-Indonesia', desc: 'Ekspansi nasional, pengembangan fitur AI, dan integrasi sistem pemerintah kabupaten/kota.', status: 'future' }
    ]
  },

  // ----- MESSAGES (from contact form) -----
  messages: [
    { id: 1, name: 'Ahmad Fauzi', email: 'ahmad@example.com', whatsapp: '081234567890', nagari: 'Nagari Kuamang Alai', paket: 'Paket Komplet', pesan: 'Saya tertarik dengan Paket Komplet. Mohon info lebih lanjut.', date: '2026-06-05 14:30', read: false },
    { id: 2, name: 'Budi Santoso', email: 'budi@example.com', whatsapp: '081298765432', nagari: 'Nagari Pelangiran', paket: 'Paket Dasar', pesan: 'Apakah ada demo untuk Paket Dasar?', date: '2026-06-04 10:15', read: false },
    { id: 3, name: 'Siti Rahma', email: 'siti@example.com', whatsapp: '087812345678', nagari: 'Nagari Sungai Aua', paket: 'Belum Yakin', pesan: 'Tolong dijelaskan perbedaan tiap paket.', date: '2026-06-03 09:00', read: true }
  ],

  // ----- SETTINGS -----
  settings: {
    siteName: 'Nagari Digital',
    tagline: 'Platform Digital Terintegrasi untuk Pemerintahan Nagari',
    logoIcon: 'fa-leaf',
    footerDesc: 'Platform digital terintegrasi untuk pemerintahan Nagari/Desa di seluruh Indonesia. Mewujudkan tata kelola pemerintahan yang modern, transparan, dan efisien.',
    whatsapp: '6282284186104',
    email: 'info@nagaridigital.web.id',
    location: 'Sumatera Barat, Indonesia',
    social: {
      facebook: '#',
      instagram: '#',
      youtube: '#'
    },
    seo: {
      description: 'Nagari Digital — Platform digital terintegrasi untuk pemerintahan Nagari/Desa. Website resmi, aplikasi pelayanan kependudukan, pendataan penduduk, posyandu, dan manajemen jorong.',
      keywords: 'Nagari digital, desa digital, website desa, aplikasi desa, pelayanan kependudukan, posyandu digital'
    },
    demo: {
      email: 'admin@demo.id',
      password: 'demo1234',
      demoUrl: 'https://kuamangalai-ug.nagaridigital.web.id/'
    }
  }

}; // end NagariData
