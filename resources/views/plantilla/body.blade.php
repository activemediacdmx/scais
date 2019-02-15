<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
  <div id="initpreloader">;
  	   <div id="initloader"></div>
  </div>

  <div class="m-page-loader m-page-loader--base m-page-loader--non-block" style="margin-left: -80px; margin-top: -20px;">
  	<div class="m-blockui">
  		<span>
  			Cargando ...
  		</span>
  		<span>
  			<div class="m-loader m-loader--brand"></div>
  		</span>
  	</div>
  </div>

  <div class="m-grid m-grid--hor m-grid--root m-page">
    @include('plantilla/header')
    @include('plantilla/content')
    @include('plantilla/footer')
  </div>
  <?php //@include('plantilla/quicksidebar'); /*<< corresponde al sidebar derecho*/ ?>

  <div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
  </div>

  <?php //@include('plantilla/quicknav');?>
  @include('plantilla/scripts')

</body>
