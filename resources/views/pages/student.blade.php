@extends('layouts.app')
@section('content')
    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-semibold leading-none text-gray-900">
                    Member Data
                </h1>
                <div class="flex items-center gap-2 text-sm font-medium text-gray-600">
                    List of members
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="/add-student" class="btn btn-sm btn-primary">
                    <i class="ki-filled ki-add-folder"></i> Add Student
                </a>
            </div>
        </div>
    </div>
    <div class="container-fixed">
        <div class="grid">
            <div class="card card-grid min-w-full">
             <div class="card-header py-5 flex-wrap">
              <h3 class="card-title">
               Team Members
              </h3>
              <div class="flex gap-6">
               <div class="relative">
                <i class="ki-outline ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 left-0 -translate-y-1/2 ml-3">
                </i>
                <input class="input input-sm pl-8" placeholder="Search Members" type="text"/>
               </div>
              </div>
             </div>
             <div class="card-body">
              <div data-datatable="true" data-datatable-page-size="5">
               <div class="scrollable-x-auto">
                <table class="table table-auto table-border" data-datatable-table="true" id="grid_table">
                 <thead>
                  <tr>
                   <th class="w-[60px]">
                    <input class="checkbox checkbox-sm" data-datatable-check="true" type="checkbox"/>
                   </th>
                   <th class="min-w-[175px]">
                    <span class="sort asc">
                     <span class="sort-label">
                      Member
                     </span>
                     <span class="sort-icon">
                     </span>
                    </span>
                   </th>
                   <th class="min-w-[150px]">
                    <span class="sort">
                     <span class="sort-label">
                      Location
                     </span>
                     <span class="sort-icon">
                     </span>
                    </span>
                   </th>
                   <th class="min-w-[125px]">
                    <span class="sort">
                     <span class="sort-label">
                      Status
                     </span>
                     <span class="sort-icon">
                     </span>
                    </span>
                   </th>
                   <th class="w-[80px]">
                    <span class="sort">
                        <span class="sort-label">
                         Action
                        </span>
                        <span class="sort-icon">
                        </span>
                       </span>
                   </th>
                  </tr>
                 </thead>
                 <tbody>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="1"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-3.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Tyler Hero
                      </a>
                      <span class="text-2sm text-gray-600">
                       26 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/estonia.svg"/>
                     <span class="leading-none text-gray-700">
                      Estonia
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-success">
                     Active
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="2"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-2.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Esther Howard
                      </a>
                      <span class="text-2sm text-gray-600">
                       639 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/malaysia.svg"/>
                     <span class="leading-none text-gray-700">
                      Malaysia
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-warning">
                     Pending
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="3"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-11.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Jacob Jones
                      </a>
                      <span class="text-2sm text-gray-600">
                       125 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/ukraine.svg"/>
                     <span class="leading-none text-gray-700">
                      Ukraine
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-primary">
                     Active
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="4"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-2.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Cody Fisher
                      </a>
                      <span class="text-2sm text-gray-600">
                       81 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/canada.svg"/>
                     <span class="leading-none text-gray-700">
                      Canada
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-danger">
                     Deleted
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="5"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-5.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Leslie Alexander
                      </a>
                      <span class="text-2sm text-gray-600">
                       203 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/india.svg"/>
                     <span class="leading-none text-gray-700">
                      India
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-success">
                     Active
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="6"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-6.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Martha Craig
                      </a>
                      <span class="text-2sm text-gray-600">
                       344 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/brazil.svg"/>
                     <span class="leading-none text-gray-700">
                      Brazil
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-warning">
                     Pending
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="7"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-7.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Ronald Richards
                      </a>
                      <span class="text-2sm text-gray-600">
                       187 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/japan.svg"/>
                     <span class="leading-none text-gray-700">
                      Japan
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-success">
                     Active
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="8"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-8.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Jane Cooper
                      </a>
                      <span class="text-2sm text-gray-600">
                       45 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/south_africa.svg"/>
                     <span class="leading-none text-gray-700">
                      South Africa
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-secondary">
                     Inactive
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                  <tr>
                   <td>
                    <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="9"/>
                   </td>
                   <td>
                    <div class="flex items-center gap-2.5">
                     <img alt="" class="h-9 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/avatars/300-9.png"/>
                     <div class="flex flex-col gap-0.5">
                      <a class="leading-none font-semibold text-sm text-gray-900 hover:text-primary" href="#">
                       Robert Fox
                      </a>
                      <span class="text-2sm text-gray-600">
                       512 tasks
                      </span>
                     </div>
                    </div>
                   </td>
                   <td>
                    <div class="flex items-center gap-1.5">
                     <img alt="flag" class="h-4 rounded-full" src="/static/metronic/tailwind/docs/dist/assets/media/flags/germany.svg"/>
                     <span class="leading-none text-gray-700">
                      Germany
                     </span>
                    </div>
                   </td>
                   <td>
                    <span class="badge badge-sm badge-outline badge-success">
                     Active
                    </span>
                   </td>
                   <td>
                    <a href="#">
                        <i class="ki-filled ki-notepad-edit text-3xl text-warning mr-3"></i>
                    </a>
                    <a href="#">
                        <i class="ki-filled ki-trash-square text-3xl text-danger"></i>
                    </a>
                   </td>
                  </tr>
                 </tbody>
                </table>
               </div>
               <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-3 text-gray-600 text-2sm font-medium">
                <div class="flex items-center gap-2">
                 Show
                 <select class="select select-sm w-16" data-datatable-size="true" name="perpage">
                 </select>
                 per page
                </div>
                <div class="flex items-center gap-4">
                 <span data-datatable-info="true">
                 </span>
                 <div class="pagination" data-datatable-pagination="true">
                 </div>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
    </div>
@endsection