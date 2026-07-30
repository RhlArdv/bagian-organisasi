import re

with open('resources/views/layouts/app.blade.php', 'r') as f:
    content = f.read()

# Define blocks using regex or string splitting
# It's safer to just extract by line numbers or patterns since we know them

def get_block(start_str, end_str):
    start_idx = content.find(start_str)
    end_idx = content.find(end_str, start_idx)
    return content[start_idx:end_idx].strip()

# Dashboard
dashboard = """<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-4">Menu Utama</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-brand-50 text-brand-500 font-bold' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-squares-four text-xl"></i>
                    <span class="text-sm">Dashboard Overview</span>
                </a>"""

# Pengaturan Beranda (Banner, Metrics)
banner_metrics = """<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pengaturan Beranda</p>

                <a href="{{ route('banners.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('banners.*') ? 'bg-brand-50 text-brand-500 font-bold' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-image text-xl"></i>
                    <span class="text-sm">Banner / Slider Utama</span>
                </a>

                <a href="{{ route('metrics.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('metrics.*') ? 'bg-brand-50 text-brand-500 font-bold' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-chart-bar text-xl"></i>
                    <span class="text-sm">Indikator Kinerja (RB, dkk)</span>
                </a>"""

# Profil
profil = """<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Profil</p>
                <a href="{{ route('pegawai.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('pegawai.*') ? 'bg-brand-50 text-brand-500 font-bold' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-users text-xl"></i>
                    <span class="text-sm">Profil Pegawai</span>
                </a>

                <a href="{{ route('pages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('pages.*') ? 'bg-brand-50 text-brand-500 font-bold' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-file-text text-xl"></i>
                    <span class="text-sm">Halaman Profil (Visi, dkk)</span>
                </a>"""

kelembagaan = get_block('<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Kelembagaan</p>', '<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pelayanan Publik</p>')

anjab = get_block('<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Kinerja & Analisis</p>', '<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Regulasi</p>').replace('Kinerja & Analisis', 'Analisis Jabatan & ABK')

pelayanan = get_block('<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pelayanan Publik</p>', '<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Tata Laksana</p>')

tatalaksana = get_block('<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Tata Laksana</p>', '<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Reformasi Birokrasi</p>')

rb = get_block('<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Reformasi Birokrasi</p>', '<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Kinerja & Analisis</p>')

regulasi = get_block('<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Regulasi</p>', '<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Konten & Informasi</p>')

konten = get_block('<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Konten & Informasi</p>', '<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pengaturan Beranda</p>')

kontak = """<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pengaturan Kontak</p>
                <a href="{{ route('settings.contact') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('settings.contact') ? 'bg-brand-50 text-brand-500 font-bold' : 'text-gray-500 font-medium hover:bg-gray-50 hover:text-gray-900' }}">
                    <i class="ph-bold ph-address-book text-xl"></i>
                    <span class="text-sm">Kontak & Lokasi</span>
                </a>"""

akun = get_block('<p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 mt-8">Pengaturan Akun</p>', '</div>\n\n            {{-- Sidebar Footer (Logout) --}}')

# Combine them all
new_menu = "\n\n                ".join([
    dashboard,
    banner_metrics,
    profil,
    kelembagaan,
    anjab,
    pelayanan,
    tatalaksana,
    rb,
    regulasi,
    konten,
    kontak,
    akun
])

start_marker = '<div class="flex-1 overflow-y-auto py-6 px-4 space-y-1">'
end_marker = '            </div>\n\n            {{-- Sidebar Footer (Logout) --}}'

full_start_idx = content.find(start_marker)
full_end_idx = content.find(end_marker)

new_content = content[:full_start_idx + len(start_marker)] + "\n                " + new_menu + "\n" + content[full_end_idx:]

with open('resources/views/layouts/app.blade.php', 'w') as f:
    f.write(new_content)

print("SUCCESS")
