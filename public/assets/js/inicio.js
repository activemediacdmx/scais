var SessionTimeout = function () {

    var handlesessionTimeout = function () {
        $.sessionTimeout({
            warnAfter: 10000,
            redirAfter: 30000
        });
    }
    return {
        init: function () {
            handlesessionTimeout();
        }
    };

}();

jQuery(document).ready(function() {
   SessionTimeout.init();
});


function keepAliveDirect(){
	$.ajax({url: 'login/keepAliveReset'});
}


$("body").on("click", "#m_portlet_tools_2", function() {

  //$(".m-portlet").addClass('m-portlet--fullscreen');
  var e = $(this).mPortlet();

  e.on("beforeCollapse", function(e) {

  }), e.on("afterCollapse", function(e) {

  }), e.on("beforeExpand", function(e) {

  }), e.on("afterExpand", function(e) {

  }), e.on("beforeRemove", function(e) {

  }), e.on("afterRemove", function(e) {

  }), e.on("reload", function(e) {

  });
});
