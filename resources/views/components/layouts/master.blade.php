<!DOCTYPE html>
<html lang="en" x-data="darkMode()" :data-theme="theme" x-init="init()">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-COMMERCE</title>

	<!-- CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
	@stack('css')
	@livewireStyles

	<style>
		/* ===================== GLOBAL RESET ===================== */
		.dropdown-toggle::after {
			display: none !important;
		}

		/* ======== TRANSISI HALUS UNTUK SEMUA ELEMEN ======== */
		body,
		.card,
		.navbar,
		.footer,
		section,
		.btn,
		.table {
			transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
		}

		/* ======== DEFAULT LIGHT MODE ======== */
		:root {
			--bs-body-bg: #f8f9fa;
			--bs-body-color: #212529;
			--card-bg: #ffffff;
			--card-border: #dee2e6;
			--hero-overlay: rgba(0, 0, 0, 0.55);
			--btn-light-border: #ced4da;
			--text-muted: #6c757d;
			--navbar-bg: #ffffff;
			--footer-bg: #f1f3f5;
		}

		/* ======== AUTO DARK MODE (PREFERENSI SISTEM) ======== */
		@media (prefers-color-scheme: dark) {
			:root {
				--bs-body-bg: #121212;
				--bs-body-color: #e0e0e0;
				--card-bg: #1e1e1e;
				--card-border: #333;
				--hero-overlay: rgba(0, 0, 0, 0.65);
				--btn-light-border: #444;
				--text-muted: #b0b0b0;
				--navbar-bg: #1a1a1a;
				--footer-bg: #1b1b1b;
			}
		}

		/* ======== OVERRIDE THEME (MANUAL PILIHAN USER) ======== */
		[data-theme="dark"] {
			--bs-body-bg: #121212 !important;
			--bs-body-color: #e0e0e0 !important;
			--card-bg: #1e1e1e !important;
			--card-border: #333 !important;
			--hero-overlay: rgba(0, 0, 0, 0.65) !important;
			--btn-light-border: #444 !important;
			--text-muted: #b0b0b0 !important;
			--navbar-bg: #1a1a1a !important;
			--footer-bg: #1b1b1b !important;
		}

		[data-theme="light"] {
			--bs-body-bg: #f8f9fa !important;
			--bs-body-color: #212529 !important;
			--card-bg: #ffffff !important;
			--card-border: #dee2e6 !important;
			--hero-overlay: rgba(0, 0, 0, 0.55) !important;
			--btn-light-border: #ced4da !important;
			--text-muted: #6c757d !important;
			--navbar-bg: #ffffff !important;
			--footer-bg: #f1f3f5 !important;
		}

		/* ======== APLIKASI VARIABEL WARNA ======== */
		body {
			background-color: var(--bs-body-bg) !important;
			color: var(--bs-body-color) !important;
		}

		.navbar {
			background-color: var(--navbar-bg) !important;
			color: var(--bs-body-color) !important;
		}

		.footer {
			background-color: var(--footer-bg) !important;
			color: var(--bs-body-color) !important;
		}

		.card {
			background-color: var(--card-bg) !important;
			border-color: var(--card-border) !important;
		}

		.text-muted {
			color: var(--text-muted) !important;
		}

		.btn-outline-light {
			border-color: var(--btn-light-border) !important;
			color: var(--bs-body-color) !important;
		}

		.table {
			color: var(--bs-body-color) !important;
			border-color: var(--card-border) !important;
			background-color: var(--card-bg) !important;
		}

		section {
			background-color: var(--bs-body-bg) !important;
			color: var(--bs-body-color) !important;
		}

		/* ======== HERO SECTION ======== */
		.hero-section {
			position: relative;
		}

		.hero-section .overlay {
			background-color: var(--hero-overlay) !important;
			position: absolute;
			inset: 0;
		}

		/* ======== REPAIR SECTION ======== */
		.repair-content {
			background-color: var(--card-bg);
			color: var(--bs-body-color);
			border-radius: 0.5rem;
			padding: 1rem;
		}

		/* ======== BADGE AGAR TETAP KONTRAS ======== */
		[data-theme="dark"] .badge.bg-light {
			background-color: #333 !important;
			color: #f8f9fa !important;
		}

		/* ===================== NAVBAR FIX ===================== */
		.navbar .nav-link,
		.navbar-brand {
			color: var(--bs-body-color) !important;
		}
		h1 {
            font-family: "Bebas Neue", sans-serif;
            font-style: normal;
        }

		body {
			font-family: 'Inconsolata', monospace;
		}
	</style>

</head>

<body class="d-flex flex-column min-vh-100">

	<!-- Navbar -->
	<livewire:atom.navbar-user />

	<main>
		{{ $slot }}
	</main>

	<footer class="mt-auto">
		<livewire:atom.footer-user />
	</footer>

	@livewireScripts
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Alpine dark mode -->
	<script>
		function darkMode() {
			return {
				theme: localStorage.getItem('theme') || '',

				init() {
					// Jika pengguna belum memilih manual, biarkan sistem yang atur (CSS)
					if (!this.theme) return;

					// Jika sudah pernah pilih, override sistem
					document.documentElement.setAttribute('data-theme', this.theme);
				},

				toggle() {
					if (this.theme === 'dark') {
						this.theme = 'light';
					} else {
						this.theme = 'dark';
					}
					localStorage.setItem('theme', this.theme);
					document.documentElement.setAttribute('data-theme', this.theme);
				}
			};
		}

		document.addEventListener('livewire:navigated', () => {
			const theme = localStorage.getItem('theme') || 'dark';
			if (theme) document.documentElement.setAttribute('data-theme', theme);
		});
	</script>
	@stack('scripts')
</body>

</html>