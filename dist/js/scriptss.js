function triggerClick() {
    document.querySelector('#profilImg').click();
}

function displayImage(e) {
    if (e.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('#profiledisplay').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}

function triggerClick_edit() {
    document.querySelector('#profilImg_edit').click();
}

function displayImage_edit(e) {
    if (e.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('#profiledisplay_edit').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}
/////////////////////////////////////////////////////////////////////////////////////2

function triggerClick2() {
  document.querySelector('#profilImg2').click();
}

function displayImage2(e) {
  if (e.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
          document.querySelector('#profiledisplay2').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
  }
}

function triggerClick_edit2() {
  document.querySelector('#profilImg_edit2').click();
}

function displayImage_edit2(e) {
  if (e.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
          document.querySelector('#profiledisplay_edit2').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
  }
}


// ////////////////////////////////////////////////3

function triggerClick3() {
  document.querySelector('#profilImg3').click();
}

function displayImage3(e) {
  if (e.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
          document.querySelector('#profiledisplay3').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
  }
}

function triggerClick_edit3() {
  document.querySelector('#profilImg_edit3').click();
}

function displayImage_edi3t(e) {
  if (e.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
          document.querySelector('#profiledisplay_edit3').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
  }
}








// ////////////////////////////////////////////////////////////////
function updateUserStatus(){
    jQuery.ajax({
      url:'../resources/templates/update_user_status.php',
      success:function(){
  
      }
    })
  }
  function getUserStatus(){
    jQuery.ajax({
      url:'../resources/templates/get_user_status.php',
      success:function(result){
        jQuery('#user_grid').html(result);
      }
    })
  }
  
  setInterval(function(){
    updateUserStatus();
  },3000);
  
  setInterval(function(){
    getUserStatus();
  },7000);
  