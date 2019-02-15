<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
  <a href="#" class="m-nav__link m-dropdown__toggle">
    <span class="m-topbar__userpic">
      <img id="avatar_top1" src="plugs/timthumb.php?src=<?=$datos['avatar_usr_circ']?>&w=80&h=80&a=t" class="m--img-rounded m--marginless m--img-centered" alt=""/>
    </span>
  </a>
  <div class="m-dropdown__wrapper">
    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
    <div class="m-dropdown__inner">
      <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/notification_bg.jpg); background-size: cover;">
        <div class="m-card-user m-card-user--skin-dark">
          <div class="m-card-user__pic">
            <img id="avatar_top2" src="plugs/timthumb.php?src=<?=$datos['avatar_usr_circ']?>&w=80&h=80&a=t" class="m--img-rounded m--marginless" alt=""/>
          </div>
          <div class="m-card-user__details">
            <span class="m-card-user__name m--font-weight-500">
              <?=$datos['usuario_menu_top']['nombres']?>
            </span>
            <a href="" class="m-card-user__email m--font-weight-300 m-link">
              <?=$datos['usuario_menu_top']['correo']?>
            </a>
          </div>
        </div>
      </div>
      <div class="m-dropdown__body">
        <div class="m-dropdown__content">
          <ul class="m-nav m-nav--skin-light">
            <li class="m-nav__section m--hide">
              <span class="m-nav__section-text">
                Section
              </span>
            </li>

            <?php if(Helpme::tiene_permiso('Usuarios|perfil')){ ?>
            <li class="m-nav__item">
              <a href="javascript:void(0)" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL')?>usuarios/perfil');" class="m-nav__link">
                <i class="m-nav__link-icon flaticon-profile-1"></i>
                <span class="m-nav__link-title">
                  <span class="m-nav__link-wrap">
                    <span class="m-nav__link-text">
                      Mi perfil
                    </span>
                  </span>
                </span>
              </a>
            </li>
            <?php } ?>


            <?php if(Helpme::tiene_permiso('Usuarios|index')){ ?>
            <li class="m-nav__item">
              <a href="javascript:void(0)" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL')?>usuarios');" class="m-nav__link">
                <i class="m-nav__link-icon flaticon-users"></i>
                <span class="m-nav__link-text">
                  Control de usuarios
                </span>
              </a>
            </li>
            <?php } ?>


            <?php if(Helpme::tiene_permiso('Controllers|index')){ ?>
            <li class="m-nav__item">
              <a href="javascript:void(0)" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL')?>controllers');" class="m-nav__link">
                <i class="m-nav__link-icon flaticon-interface-3"></i>
                <span class="m-nav__link-text">
                  Controladores
                </span>
              </a>
            </li>
            <?php } ?>


            <li class="m-nav__separator m-nav__separator--fit"></li>

            <?php if(isset($_SESSION['token'])){ ?>
            <li class="m-nav__item">
              <a href="<?=env('APP_URL')?>" target="_blank" class="m-nav__link">
                <i class="m-nav__link-icon flaticon-browser"></i>
                <span class="m-nav__link-text">
                  Site
                </span>
              </a>
            </li>
            <li class="m-nav__item">
              <a href="<?=env('APP_URL')?>login/lockSession" class="m-nav__link">
                <i class="m-nav__link-icon flaticon-lock"></i>
                <span class="m-nav__link-text">
                  Bloquear
                </span>
              </a>
            </li>
            <li class="m-nav__separator m-nav__separator--fit"></li>
            <li class="m-nav__item">
              <span id="comm_js_fn_01" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">

                Salir
                &nbsp;&nbsp;
                <i class="m-nav__link-icon flaticon-logout"></i>

              </span>
            </li>
            <?php } ?>

          </ul>
        </div>
      </div>
    </div>
  </div>
</li>
