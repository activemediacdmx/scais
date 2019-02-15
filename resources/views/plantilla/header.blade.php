<header id="m_header" class="m-grid__item    m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200" >
  <div class="m-container m-container--fluid m-container--full-height">
    <div class="m-stack m-stack--ver m-stack--desktop">
      @include('plantilla/logotipo')
      <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
          <i class="la la-close"></i>
        </button>


        <!-- Corresponde a los breadcrumbs cuando estan en el lugar del menu, se modificaron para dar lugar al menu-->

        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
           <h5 class="m-subheader__title m-subheader__title--separator" id="breadcrumb-title" style="top: 33px; position: relative;">
              <?=env('APP_NAME')?>
           </h5>
        </div>


        <?php //@include('plantilla/top_left_menu');?>

        @include('plantilla/top_right_menu')

      </div>
    </div>
  </div>
</header>
<!-- END: Header -->
