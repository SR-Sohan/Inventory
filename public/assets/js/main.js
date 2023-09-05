
function showLoader(){
    document.getElementById("loader").classList.remove("d-none")
}

function hideLoader(){
    document.getElementById("loader").classList.add("d-none")
}

function successToast(msg){
    Toastify({
        text: msg,    
        gravity: "bottom", 
        position: "center", 
        className: "mb-5",
        style: {
          background: "green",
        },
      }).showToast();
}
function errorToast(msg){
    Toastify({
        text: msg,    
        gravity: "bottom", 
        position: "center", 
        className: "mb-5",
        style: {
          background: "red",
        },
      }).showToast();
}