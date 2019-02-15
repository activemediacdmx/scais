<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <div
    id="m_ver_menu"
    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
    m-menu-vertical="1"
    m-menu-scrollable="0" m-menu-dropdown-timeout="500"
    >
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
      <li class="m-menu__section ">
        <h4 class="m-menu__section-text">
          Componentes
        </h4>
        <i class="m-menu__section-icon flaticon-more-v3"></i>
      </li>

      <?php
         if(
           (Helpme::tiene_permiso('Usuarios|index')) OR
           (Helpme::tiene_permiso('Controllers|index')) OR
           (Helpme::tiene_permiso('Usuarios|logueados')) OR
           (Helpme::tiene_permiso('Catalogo|index')) OR
           (Helpme::tiene_permiso('Usuarios|perfil')) OR
           (Helpme::tiene_permiso('Login|loginlogger')) OR
           (Helpme::tiene_permiso('Sistemas|index')) OR
           (Helpme::tiene_permiso('Login|auditoria'))
         )
         {
      ?>

      <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"  m-menu-submenu-toggle="hover">
        <a  href="javascript:;" class="m-menu__link m-menu__toggle">
          <i class="m-menu__link-icon flaticon-network"></i>
          <span class="m-menu__link-text">
            <?=env('APP_NAME')?>
          </span>
          <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu ">
          <span class="m-menu__arrow"></span>
          <ul class="m-menu__subnav">

            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
              <span class="m-menu__link">
                <span class="m-menu__link-text">
                  <?=env('APP_NAME')?>
                </span>
              </span>
            </li>

            <?php if(Helpme::tiene_permiso('Usuarios|perfil')){ ?>


              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>usuarios/perfil');" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-profile-1"></i><span class="m-menu__link-text">Mi perfil</span></a>
              </li>

            <?php }if(Helpme::tiene_permiso('Sistemas|index')){ ?>


                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>sistemas');" class="m-menu__link m-menu__toggle">
                  <i class="m-menu__link-icon flaticon-imac"></i><span class="m-menu__link-text">Sistemas</span></a>
                </li>

            <?php }if(Helpme::tiene_permiso('Usuarios|index')){ ?>


              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>usuarios');" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-user-settings"></i><span class="m-menu__link-text">Control de usuarios</span></a>
              </li>


            <?php }

            if(Helpme::tiene_permiso('Controllers|index')){ ?>


              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-user-ok"></i><span class="m-menu__link-text">Roles & Permisos</span><i
									 class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true"><a href="javascript:;" id="rls_js_fn_02" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Roles</span></a></li>
										<li class="m-menu__item " aria-haspopup="true"><a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>controllers');" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Permisos</span></a></li>
									</ul>
								</div>
							</li>

            <?php }

            if(Helpme::tiene_permiso('Usuarios|logueados')){ ?>

              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>usuarios/logueados');" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-logout"></i><span class="m-menu__link-text">Control de sesiones</span></a>
              </li>

            <?php }if(Helpme::tiene_permiso('Login|loginlogger')){ ?>

            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>login/loginlogger');" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-logout"></i><span class="m-menu__link-text">Registro de accesos</span></a>
            </li>

            <?php }if(Helpme::tiene_permiso('Catalogo|index')){ ?>

              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>catalogo');" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-folder-1"></i><span class="m-menu__link-text">Catálogo</span></a>
              </li>


            <?php }if(Helpme::tiene_permiso('Login|auditoria')){ ?>

              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>login/auditoria');" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-eye"></i><span class="m-menu__link-text">Auditoría</span></a>
              </li>

            <?php } ?>
          </ul>
        </div>
      </li>
      <?php } ?>


      <?php
        for($i=0;$i < count($datos['lista_sistemas']); $i++){
      ?>

      <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"  m-menu-submenu-toggle="hover" id="system_menu_<?=$datos['lista_sistemas'][$i]->id_sistema?>">
        <a  href="javascript:;" class="m-menu__link m-menu__toggle">
          <i class="m-menu__link-icon flaticon-network"></i>
          <span class="m-menu__link-text">
            <?=$datos['lista_sistemas'][$i]->nombre?>
          </span>
          <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu ">
          <span class="m-menu__arrow"></span>
          <ul class="m-menu__subnav">

            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
              <span class="m-menu__link">
                <span class="m-menu__link-text">
                  <?=$datos['lista_sistemas'][$i]->nombre?>
                </span>
              </span>
            </li>

            <?php if(Helpme::tiene_permiso('Usuarios|index')){ ?>


              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>systemusers/listado/<?=$datos['lista_sistemas'][$i]->id_sistema?>');" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-user-settings"></i><span class="m-menu__link-text">Control de usuarios</span></a>
              </li>


            <?php }if(Helpme::tiene_permiso('Controllers|index')){ ?>


              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-user-ok"></i><span class="m-menu__link-text">Roles & Permisos</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true">
                      <a data-function="<?=$datos['lista_sistemas'][$i]->id_sistema?>" href="javascript:;" id="sys_js_fn_06" class="m-menu__link ">
                        <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Roles</span></a></li>
										<li class="m-menu__item " aria-haspopup="true">
                      <a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>permisos/main/<?=$datos['lista_sistemas'][$i]->id_sistema?>');" class="m-menu__link ">
                        <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Permisos</span></a></li>
									</ul>
								</div>
							</li>

            <?php }

            if(Helpme::tiene_permiso('Usuarios|logueados')){ ?>

              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>systemusers/logueados/<?=$datos['lista_sistemas'][$i]->id_sistema?>');" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-logout"></i><span class="m-menu__link-text">Control de sesiones</span></a>
              </li>

            <?php }if(Helpme::tiene_permiso('Login|loginlogger')){ ?>

            <li class="m-menu__item " aria-haspopup="true" >
                <a  href="javascript:;" onclick="carga_archivo('contenedor_principal','<?=env('APP_URL ')?>systemusers/loginlogger/<?=$datos['lista_sistemas'][$i]->id_sistema?>');" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-logout"></i><span class="m-menu__link-text">Registro de accesos</span></a>
            </li>

            <?php } ?>
          </ul>
        </div>
      </li>

      <?php
      }
      ?>



    </ul>
  </div>
  <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
