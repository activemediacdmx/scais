<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
  <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
  </button>

  @include('plantilla/left_sidebar_menu')

  <div class="m-grid__item m-grid__item--fluid m-wrapper">
    <?php //@include('plantilla/subheader')?>
    <div class="m-content" id="contenedor_principal">
        @include('inicio/index')
    </div>
  </div>

</div>
