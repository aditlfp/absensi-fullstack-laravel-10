<div class="sm:ml-10 hidden sm:flex  bg-[#0EF6CC]/70 rounded-md shadow-md mb-[12.5rem] h-fit">
    <div>
        <ul class="menu menu-sm bg-base-200 rounded-lg m-2">
            <li class="font-bold"><a>
                    List Menu
                </a></li>
            <li class="w-[14rem] pr-5">
                {{-- absen --}}
                
                <details {{ (request()->routeIs('admin.absen') || request()->routeIs('data-izin.admin') || request()->routeIs('lemburList')) ? 'open' : 'close'}}>
                    <summary>
                        <i class="ri-calendar-todo-line text-lg"></i>
                        Menu Absensi
                    </summary>
                    <ul>
                        <li class="{{ request()->routeIs('admin.absen') ? 'bg-slate-300' : '' }}"><a href="{{ route('admin.absen') }}">
                                <i class="ri-list-check-3 text-lg"></i>
                                Data Kehadiran
                            </a></li>
                        <li><a href="{{ route('data-izin.admin') }}">
                                <i class="ri-shield-user-line text-lg"></i>
                                Data Izin
                            </a></li>
                        <li><a href="{{ route('lemburList') }}">
                            <i class="ri-time-line text-lg"></i>
                            Data Lembur
                        </a></li>
                    </ul>
                </details>
                
                {{-- Laporan --}}
                <details close>
                    <summary>
                        <i class="ri-task-line text-lg"></i>
                        Menu Laporan
                    </summary>
                    <ul>
                        <li><a href="{{ route('laporan.index') }}">
                            <i class="ri-calendar-2-line text-lg"></i>
                                Data Laporan
                            </a></li>
                    </ul>
                </details>
                <div class="divider -my-1"></div>
                {{-- user --}}
                <details close>
                    <summary>
                        <i class="ri-folder-user-line text-lg"></i>
                        Menu User
                    </summary>
                    <ul>
                        <li><a href="{{ route('users.index') }}">
                                <i class="ri-user-line text-lg"></i>
                                Data User
                            </a></li>
                        <li><a href="{{ route('users.create') }}">
                                <i class="ri-user-add-line text-lg"></i>
                                Tambah User
                            </a></li>
                    </ul>
                </details>
                {{-- devisi --}}
                <details close>
                    <summary>
                        <i class="ri-group-2-line text-lg"></i>
                        Menu Devisi
                    </summary>
                    <ul>
                        <li><a href="{{ route('devisi.index') }}">
                                <i class="ri-team-line text-lg"></i>
                                Data Devisi
                            </a></li>
                        <li><a href="{{ route('devisi.create') }}">
                                <i class="ri-add-line text-lg"></i>
                                Tambah Devisi
                            </a></li>
                    </ul>
                </details>
                {{-- jabatan --}}
                <details close>
                    <summary>
                        <i class="ri-medal-line text-lg"></i>
                        Menu Jabatan
                    </summary>
                    <ul>
                        <li><a href="{{ route('jabatan.index') }}">
                                <i class="ri-award-line text-lg"></i>
                                Data Jabatan
                            </a></li>
                        <li><a href="{{ route('jabatan.create') }}">
                                <i class="ri-add-line text-lg"></i>
                                Tambah Jabatan
                            </a></li>
                    </ul>
                </details>
                {{-- jadwal --}}
                <details close>
                    <summary>
                        <i class="ri-calendar-event-line text-lg"></i>
                        Menu Jadwal
                    </summary>
                    <ul>
                        <li><a href="{{ route('admin-jadwal.index') }}">
                                <i class="ri-calendar-2-line text-lg"></i>
                                Data Jadwal
                            </a></li>
                        
                    </ul>
                </details>
                <div class="divider -my-1"></div>
                {{-- Client --}}
                <details close>
                    <summary>
                        <i class="ri-p2p-line text-lg"></i>
                        Menu Client
                    </summary>
                    <ul>
                        <li><a href="{{ route('data-client.index') }}">
                                <i class="ri-user-5-line text-lg"></i>
                                Data Client
                            </a></li>
                        <li><a href="{{ route('data-client.create') }}">
                                <i class="ri-add-line text-lg"></i>
                                Tambah Client
                            </a></li>
                    </ul>
                </details>
                {{-- Shift --}}
                <details close>
                    <summary>
                        <i class="ri-timer-line text-lg"></i>
                        Menu Shift
                    </summary>
                    <ul>
                        <li><a href="{{ route('shift.index') }}">
                                <i class="ri-timer-flash-line text-lg"></i>
                                Data Shift
                            </a></li>
                        <li><a href="{{ route('shift.create') }}">
                                <i class="ri-add-line text-lg"></i>
                                Tambah Shift
                            </a></li>
                    </ul>
                </details>
                {{-- kerja bagus --}}
                <details close>
                    <summary>
                        <i class="ri-shake-hands-line text-lg"></i>
                        Menu Kerjasama
                    </summary>
                    <ul>
                        <li><a href="{{ route('kerjasamas.index') }}">
                                <i class="ri-hand-coin-line text-lg"></i>
                                Data Kerjasama
                            </a></li>
                        <li><a href="{{ route('kerjasamas.create') }}">
                                <i class="ri-add-line text-lg"></i>
                                Tambah Kerjasama
                            </a></li>
                    </ul>
                </details>
                {{-- area --}}
                <details close>
                    <summary>
                        <i class="ri-calendar-todo-line text-lg"></i>
                        Menu Area
                    </summary>
                    <ul>
                        <li><a href="{{ route('area.index') }}">
                                <i class="ri-map-pin-2-line text-lg"></i>
                                Data Area
                            </a></li>
                    </ul>
                </details>
                {{-- ruangan --}}
                <details close>
                    <summary>
                        <i class="ri-door-open-line text-lg"></i>
                        Menu Ruangan
                    </summary>
                    <ul>
                        <li><a href="{{ route('ruangan.index') }}">
                                <i class="ri-door-open-line text-lg"></i>
                                Data Ruangan
                            </a></li>
                    </ul>
                </details>
                <div class="divider -my-1"></div>
                {{-- point --}}
                <details close>
                    <summary>
                        <i class="ri-coins-line text-lg font-normal"></i>
                        Menu Point
                    </summary>
                    <ul>
                        <li><a href="{{ route('point.index') }}">
                                <i class="ri-coins-line text-lg font-normal"></i>
                                Data Point
                            </a></li>
                        
                    </ul>
                </details>
                {{-- perlengkapan --}}
                <details close>
                    <summary>
                        <i class="ri-tools-line text-lg"></i>
                        Menu Perlengkapan
                    </summary>
                    <ul>
                        <li><a href="{{ route('perlengkapan.index') }}">
                                <i class="ri-hammer-line text-lg"></i>
                                Data Perlengkapan
                            </a></li>
                        <li><a href="{{ route('perlengkapan.create') }}">
                                <i class="ri-add-line text-lg"></i>
                                Tambah Perlengkapan
                            </a></li>
                    </ul>
                </details>
                {{-- lokasi --}}
                <details close>
                    <summary>
                        <i class="ri-road-map-line text-lg"></i>
                        Menu Lokasi
                    </summary>
                    <ul>
                        <li><a href="{{ route('lokasi.index') }}">
                                <i class="ri-pin-distance-line text-lg"></i>
                                Data Lokasi
                            </a></li>
                        <li><a href="{{ route('lokasi.create') }}">
                                <i class="ri-map-pin-add-line text-lg"></i>
                                Tambah Lokasi
                            </a></li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</div>