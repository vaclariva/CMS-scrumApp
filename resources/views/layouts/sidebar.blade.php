<div class="sidebar dark:bg-coal-600 bg-gray-900 border-r border-r-gray-200 dark:border-r-coal-100 fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0" data-drawer="true" data-drawer-class="drawer drawer-start top-0 bottom-0" data-drawer-enable="true|lg:false" id="sidebar">
    <div class="sidebar-header hidden lg:flex items-center relative justify-center px-3 lg:px-6 shrink-0" id="sidebar_header">
        <a class="dark:hidden" href="">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/logo.svg') }}"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}"/>
        </a>
        <a class="hidden dark:block" href="html/demo1.html">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/logo.svg') }}"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}"/>
        </a>
        <button class="btn btn-icon btn-icon-md size-[30px] rounded-lg border border-gray-200 dark:border-gray-300 bg-light text-gray-500 hover:text-gray-700 toggle absolute left-full top-2/4 -translate-x-2/4 -translate-y-2/4" data-toggle="body" data-toggle-class="sidebar-collapse" id="sidebar_toggle">
            <i class="ki-filled ki-black-left-line toggle-active:rotate-180 transition-all duration-300"></i>
        </button>
    </div>

    <div class="sidebar-content flex flex-col grow shrink-0 py-5 pr-2 mb-10" id="sidebar_content">
        <div class="scrollable-y-hover grow shrink-0 flex pl-2 lg:pl-5 pr-1 lg:pr-3" data-scrollable="true" data-scrollable-dependencies="#sidebar_header" data-scrollable-height="auto" data-scrollable-offset="0px" data-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
            <div class="menu flex flex-col grow gap-0.5" data-menu="true" data-menu-accordion-expand-all="false" id="sidebar_menu">
                
                <div class="flex justify-center gap-10">
                    <div class="relative">
                        <i class="ki-outline ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 left-0 -translate-y-1/2 ml-3"></i>
                        <input 
                            class="input input-sm pl-10 rounded-full h-10 px-10 bg-gray-800 border-none text-gray-500 placeholder-gray-500 text-md" 
                            placeholder="Cari" 
                            type="text"  
                            id="searchInput"
                            style="background-color:#212135; color: #a1a3a8" 
                        />                    
                    </div>
                </div>                

                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-item pt-2.25 pb-px">
                        <span class="menu-heading uppercase text-2sm font-semibold text-gray-500 pl-[10px] pr-[10px] py-5">
                            Proyek
                        </span>
                    </div>

                    
                    <div class="product-list-container overflow-y-auto max-h-[calc(10*2.5rem)]">
                        @foreach ($products as $product)
                            <div class="flex justify-between">
                                <div class="menu-item menu-item-accordion" data-menu-id="{{ $product->id }}" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                                    <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                                        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                                            <i class="{{ $product->icon }}"></i>
                                        </span>
                                        <span class="menu-title text-sm font-medium text-gray-500 menu-item-active:text-primary menu-link-hover:!text-primary">
                                            {{$product->name}}
                                        </span>
                                    </div>
                                
                                    <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200 hidden">
                                        <div class="menu-item" id="menuProduct">
                                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                                                href="{{ route('products.show', $product->id) }}" tabindex="0">
                                                <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary"></span>
                                
                                                <span class="menu-title text-2sm font-bold text-gray-500 menu-item-active:text-primary menu-item-active:font-semibold">
                                                    Product
                                                </span>
                                            </a>
                                        </div>
                                        <div class="menu-item" id="menuSprint">
                                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]"
                                                href="#" tabindex="0">
                                                <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary"></span>
                                
                                                <span class="menu-title text-2sm font-bold text-gray-500 menu-item-active:text-primary menu-item-active:font-semibold">
                                                    Sprint
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="dropdown relative" data-dropdown="true" data-dropdown-placement="bottom-end" data-dropdown-trigger="click">
                                    <button class="dropdown-toggle menu-sidebar btn">
                                        <i class="ki-filled ki-dots-horizontal text-gray-900"></i>
                                    </button>
                                    <div class="dropdown-content absolute left-0 mt-2 w-full max-w-56 py-2 bg-white shadow-lg z-10">
                                        <div class="menu menu-default flex flex-col w-full">
                                            <div class="menu-item">
                                                <a class="menu-link" id="edit_menu_item" onclick="openEditModal({id: {{ $product->id }}, name: '{{ $product->name }}', label: '{{ $product->label }}', start_date: '{{ $product->start_date }}', end_date: '{{ $product->end_date }}', user_id: '{{ $product->user_id }}', icon: '{{ $product->icon }}', url_update: '{{ route('product.update', $product->id) }}'})">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-notepad-edit"></i>
                                                    </span>
                                                    <span class="menu-title">
                                                        Edit
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <div class="flex items-center pl-5 menu-link">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-copy"></i>
                                                    </span>
                                                    <form action="{{ route('product.duplicate', $product->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-xs">Duplikat</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" id="delete_product" onclick="openDeleteModal({  id: '{{ $product->id }}', name: '{{ $product->name }}', url_delete: '{{ route('product.destroy', $product->id) }}'})">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-trash"></i>
                                                    </span>
                                                    <span class="menu-title">
                                                        Hapus
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>                                                                                                                                                                                                                
                    
                    @if ($products->isNotEmpty())
                    <div class="py-5">
                        <a type="button" class="btn flex justify-center inline-block px-2 py-2 border-2 border-dashed border-gray-400 rounded-full text-gray-400 text-sm" data-modal-toggle="#modal_6_3">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="20px" viewBox="0 0 24 24" version="1.1">
                                <title>Stockholm-icons / Navigation / Plus</title>
                                <desc>Created with Sketch.</desc>
                                <defs/>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#636674" x="4" y="11" width="16" height="2" rx="1"/>
                                    <rect fill="#636674" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                </g>
                            </svg></span>Tambah Produk
                        </a> 
                    </div>
                    @else
                        <span class="text-gray-500 text-sm text-center">Belum Ada Produk</span>
                    @endif
                                      

                    <div class="menu-item pt-2.25 pb-px">
                        <span class="menu-heading uppercase text-2sm font-semibold text-gray-500 pl-[10px] pr-[10px] pt-5 pb-2">
                            Sistem
                        </span> 
                    </div>

                    <a href="/user" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px] hover:border-gray-500" tabindex="0">
                        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                            <i class="ki-duotone ki-user text-lg menu-link-hover:!text-primary"></i>
                        </span>
                        <span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Pengguna
                        </span>
                    </a>

                    <a href="/pengaturan" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px] hover:border-gray-500" tabindex="0">
                        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                            <i class="ki-duotone ki-setting-2 text-lg menu-link-hover:!text-primary"></i>
                        </span>
                        <span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Pengaturan
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-300 dark:border-gray-600 pt-2 px- text-center text-gray-500 dark:text-gray-400 text-sm mt-[-10px]">
            <p>Copyright © 2024 CMS.</p>
            <p>Versi 1.0</p>     
        </div>
    </div>   
</div>


@include('components.modal.modal-edit-product')
@include('components.modal.confirm-delete-product')


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuProduct = document.getElementById('menuProduct');
        const menuSprint = document.getElementById('menuSprint');
        const menuItems = [menuProduct, menuSprint];

        function toggleActiveClass(event) {
            menuItems.forEach(item => item.classList.remove('active'));

            event.currentTarget.classList.add('active');

            sessionStorage.setItem('activeMenu', event.currentTarget.id);
        }

        menuItems.forEach(item => item.addEventListener('click', toggleActiveClass));

        const activeMenuId = sessionStorage.getItem('activeMenu');
        if (activeMenuId) {
            const activeMenuItem = document.getElementById(activeMenuId);
            if (activeMenuItem) {
                activeMenuItem.classList.add('active');
            }
        }
    });
</script>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let products = document.querySelectorAll('.menu-item-accordion');
    
        products.forEach(function(product) {
            let productName = product.querySelector('.menu-title').textContent.toLowerCase();
            if (productName.includes(filter)) {
                product.parentElement.style.display = '';
            } else {
                product.parentElement.style.display = 'none';
            }
        });
    });
    
    function toggleAccordion(element) {
        let accordion = element.nextElementSibling;
        accordion.style.display = (accordion.style.display === "none" || !accordion.style.display) ? "block" : "none";
    }
    
    document.querySelectorAll('[data-dropdown-trigger="click"]').forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            let dropdownMenu = this.querySelector('.dropdown-content');
            dropdownMenu.style.display = (dropdownMenu.style.display === 'none' || !dropdownMenu.style.display) ? 'block' : 'none';
        });
    });
</script>
