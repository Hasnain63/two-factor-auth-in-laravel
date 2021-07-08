 @section('sidebar_content')
 <!-- Sidebar -->
 <div class="sidebar" id="sidebar">
     <div class="sidebar-inner slimscroll">
         <div id="sidebar-menu" class="sidebar-menu">
             <ul>
                 <li class="menu-title">
                     <span>Main Menu</span>
                 </li>
                 <li>
                     <a href=""><span>Dashboard</span></a>
                 </li>
                 <li class="submenu">
                     <a href="#"><i class="la la-files-o"></i> <span> Ledger</span> <span class="menu-arrow"></span></a>
                     <ul style="display: none;">
                         <li><a class="active" href="{{route('ledgerUrl')}}">Ledger</a></li>
                     </ul>
                 </li>
                 <li class="submenu">
                     <a href="#"><i class="la la-pie-chart"></i> <span> Report</span> <span
                             class="menu-arrow"></span></a>
                     <ul style="display: none;">
                         <li><a href="{{route('ledgerUrl')}}">Monthly</a></li>
                     </ul>
                 </li>

             </ul>
         </div>
     </div>
 </div>
 <!-- /Sidebar -->
 @endsection