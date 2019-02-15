<!--Section: Team v.1-->
<script>
$("#breadcrumb-title").html('<?=$datos['system_data']->nombre?>');
$("#breadcrumb-title").append(' / Perfil / <?=$datos['usuario']['usuario']?>');
</script>

<div class="row">
  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__title m--hide">
            Su perfil
          </div>
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">
              <?php
              if ($datos['perfil']['avatar']){
              ?>
                    <div class="profile-userpic" id="avatar_actual">
                      <img src="../plugs/timthumb.php?src=tmp/<?=$datos['avatar']?>&w=300&h=300">
                    </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="avatar_actual">
                      <img src="../plugs/timthumb.php?src=../img/avatar.jpg&w=300&h=300">
                    </div>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              <?=$datos['usuario']['usuario_name']?>
            </span>
            <a href="" class="m-card-profile__email m-link">
              <?=$datos['rol']['descripcion']?>
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-one">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui la imagen o haz click para subir una.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      Actualmente no hay archivos
                      <strong>
                        no
                      </strong>
                      se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>

        <!--class="m-nav m-nav--hover-bg m-portlet-fit--sides"-->

        <!--class="m-widget1 m-widget1--paddingless"-->

      </div>
    </div>
  </div>
  <div class="col-xl-9 col-lg-8">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
      <div class="m-portlet__head">
        <div class="m-portlet__head-tools">
          <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                <i class="flaticon-share m--hide"></i>
                Configuración de cuenta
              </a>
            </li>
          </ul>
        </div>

        <?php //@include('plantilla/perfil_float_menu') ?>
      </div>
      <div class="tab-content">
        <div class="tab-pane active" id="m_user_profile_tab_1">
          <form class="m-form m-form--fit m-form--label-align-right" id="editar_perfil">
            <div class="m-portlet__body">
              <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                  Nombre (s)
                </label>
                <div class="col-7">
                  <input class="form-control m-input" type="text" id="nombres" name="nombres" placeholder="Nombre (s)" value="<?=$datos['usuario']['nombres']?>">
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                  Apellido paterno
                </label>
                <div class="col-7">
                  <input class="form-control m-input" type="text" id="apellido_paterno" name="apellido_paterno" placeholder="apellido paterno" value="<?=$datos['usuario']['apellido_paterno']?>">
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                  Apellido materno
                </label>
                <div class="col-7">
                  <input class="form-control m-input" type="text" id="apellido_materno" name="apellido_materno" placeholder="apellido materno" value="<?=$datos['usuario']['apellido_materno']?>">
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                  Usuario
                </label>
                <div class="col-7">
                  <input class="form-control m-input" type="text" disabled id="usuario" name="usuario" value="<?=$datos['usuario']['usuario']?>">
                  <span class="m-form__help">
                    Su nombre de usuario no puede ser editado
                  </span>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                  Correo
                </label>
                <div class="col-7">
                  <input class="form-control m-input" type="text" id="correo" name="correo" placeholder="Correo" value="<?=$datos['usuario']['correo']?>">
                </div>
              </div>


              <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                  Contraseña
                </label>
                <div class="col-7">
                  <input class="form-control m-input" type="password" id="password" name="password" value="">
                </div>
              </div>
              <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                  Repetir contraseña
                </label>
                <div class="col-7">
                  <input class="form-control m-input" type="password" id="password2" name="password2" value="">
                </div>
              </div>

            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
              <div class="m-form__actions">
                <div class="row">
                  <div class="col-2"></div>
                  <div class="col-7">
                    <?php
                    if(Helpme::tiene_permiso('Usuarios|editar_perfil')){
                    ?>
                      <a id="usr_js_fn_02" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                        Guardar
                      </a>
                    <?php
                    }
                    ?>
                    &nbsp;&nbsp;
                    <a type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                      Cancelar
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="activar_paginado" name="activar_paginado" value="1">
            <input type="hidden" id="paginacion" name="paginacion" value="20">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  $("#m-dropzone-one").dropzone({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "usuarios/upload_dropzone/perfiles/upload_avatar",
    paramName: "file",
    maxFiles: 5,
    maxFilesize: 5, // MB
    acceptedFiles: "image/*",
    accept: function(file, done) {
        //console.log(file);
        done();
    },
    init: function() {
      this.on("success", function(statics,file) {
        var img = file.split("|");

        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: app_url + 'usuarios/update_avatar/' + img[1],
          type: 'POST',
          dataType: 'json',
          success: function(resp_success){
            if (resp_success['resp'] == true) {
    					swal('Se actualizó su avatar correctamente', '', "Actualizado!");
    				}
          },
          error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PERFIL-UPD');}
        });


        $('#avatar_actual').html('<center><img src="plugs/timthumb.php?src=tmp/'+img[0]+'&w=300&h=300"></center>');
  			$('#avatar_top1').attr('src','plugs/timthumb.php?src=tmp/' + img[0] + '&w=80&h=80&a=t');
        $('#avatar_top2').attr('src','plugs/timthumb.php?src=tmp/' + img[0] + '&w=80&h=80&a=t');
      });
    }
   });


});
</script>
