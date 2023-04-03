var input = document.getElementsByTagName('input');

for (var i = 0; i < input.length; i++) {
    if (input[i].type == 'checkbox') {
        input[i].checked =false;
    }
}

var modal = document.getElementById("myModal");
var btn = document.querySelector('.btn-sua')
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
let id_array = []; 
function checked(){
    var table = document.querySelector(".table_content-sanpham");
    var tr = table.querySelectorAll("tr");
    var checkboxes = [];

    for (var i = 0; i < tr.length; i++) {
        var checkboxList = tr[i].querySelectorAll("input[type=checkbox]");
        checkboxes.push(checkboxList);
    }

    for(var i = 0; i < checkboxes.length; i++) {
        var checkboxList = checkboxes[i];
        for (var j = 0; j < checkboxList.length; j++) {
            
            if(checkboxList[j].checked){
                let str = checkboxList[j].id;
                // console.log(checkboxList[j].id);
                id_array.push(str[3]);
                
            }
        }
    }
    return id_array
}



