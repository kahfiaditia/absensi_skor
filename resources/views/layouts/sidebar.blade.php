 <div class="vertical-menu">
     <div data-simplebar class="h-100">
         <div id="sidebar-menu">
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title" key="t-menu">Menu</li>
                 <li>
                     <a href="{{ route('dashboard') }}" class="waves-effect">
                         <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">Menu</span>
                         <span key="t-dashboards">Dashboards</span>
                     </a>
                 </li>
                 <li class="menu-title" key="t-apps">Menu</li>
                  <li>
                     <a href="{{ route('pengguna.profil') }}" class="waves-effect">
                         <i class="bx bx-user-circle"></i>
                         <span key="t-calendar">Profil User</span>
                     </a>
                 </li>
                  <li>
                         <a href="{{ route('user_admin.index') }}" class="waves-effect">
                             <i class="bx bx-aperture"></i>
                             <span key="t-icons">User Management</span>
                         </a>
                     </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="bx bx-note"></i>
                         <span key="t-ecommerce">Manajemen</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         @if (Auth::user()->roles == 'Administrator')
                            <li><a href="{{ route('setting_data.index') }}" key="t-products">Jam Kerja</a></li>
                             <li><a href="{{ route('departemen.index') }}" key="t-products">Departemen</a></li>
                             <li><a href="{{ route('jabatan_data.index') }}" key="t-product-detail">Jabatan</a></li>
                             <li><a href="{{ route('skor_data.index') }}" key="t-orders">Nilai Skor</a></li>
                             <li><a href="{{ route('pegawai_data.index') }}" key="t-orders">Data Pegawai</a></li>
                         @endif
                         
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="bx bx-analyse"></i>
                         <span key="t-ecommerce">Absensi</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                             <li><a href="{{ route('absensi_pegawai.create') }}" key="t-products">Absensi</a></li>
                             {{-- <li><a href="#" key="t-product-detail">Absensi Mandiri</a></li> --}}
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="bx bx-history"></i>
                         <span key="t-ecommerce">Laporan</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         @if (Auth::user()->roles == 'Administrator')
                             <li><a href="{{ route('absensi_laporan.index') }}" key="t-products">Laporan Absensi</a></li>
                             <li><a href="{{ route('ranking.index') }}" key="t-product-detail">Laporan Skor Pegawai</a></li>
                         @endif
                         
                     </ul>
                 </li>
               
                
 
             </ul>
         </div>
     </div>
 </div>
