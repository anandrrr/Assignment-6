let base_url = "http://localhost/h/handler.php";
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var phoneno = /^\d{10}$/;


function deleteprof(id) {
    var url = base_url + "?req=delete&id=" + id;
    $.get(url, function(data, success) {

        if (data != "Delete Successfully!!!") {
            alert('Some error occurred!!!');
        } else {
            fillIt();
        }
    });
}

function updateprof(id) {
    window.location.href = "update.html?id="+id;
}

function fillIt() {
    var url = base_url + "?req=retrieve";
    var tab = document.getElementById('regData');
    var table = document.getElementById('regData').getElementsByTagName('tbody')[0];

    $.get(url, function(arr, success) {

        if (arr.length == 0) {
            tab.style.display = "none";
        } else {
            tab.style.display = "block";
            table.innerHTML = "";
            var flag = true;
            for (i = 0; i < arr.length; i++) {
                flag = false;
                var Ubutt = document.createElement("BUTTON");
                Ubutt.className = "btn-3";
                Ubutt.className += " success";
                Ubutt.innerText = "Update";
                Ubutt.setAttribute("onclick", "updateprof(" + (arr[i].id) + ")");
                var butt = document.createElement("BUTTON");
                butt.className = "btn-3";
                butt.className += " danger";
                butt.innerText = "Delete";
                butt.setAttribute("onclick", "deleteprof(" + (arr[i].id) + ")");
                var row = table.insertRow();
                var c1 = row.insertCell(0);
                var c2 = row.insertCell(1);
                var c3 = row.insertCell(2);
                var c4 = row.insertCell(3);
                var c5 = row.insertCell(4);
                var c6 = row.insertCell(5);
                c1.innerHTML = arr[i].firstn + " " + arr[i].lastn;
                c2.innerHTML = arr[i].email;
                c3.innerHTML = arr[i].gender;
                c4.innerHTML = arr[i].mobile;
                c5.append(Ubutt);
                c6.append(butt);
            }
            if (flag) {
                sh.style.display = "block";
                tab.style.display = "none";
            }
        }
    });
};

$(document).on('submit', '.regForm', function(e) {
    e.preventDefault();

    var fname = document.getElementById('fname');
    var lname = document.getElementById('lname');
    var email = document.getElementById('email');
    var gender = document.getElementById('gender');
    var mobile = document.getElementById('mobile');
    var terms = document.getElementById('terms');

    if (mobile.value.match(phoneno) == false || mailformat.test(email.value) == false || fname.value.length <= 3 || lname.value.length <= 3 || mobile.value.length != 10 || terms.checked == false) {
        alert("Form was not properly Filled");
    } else {
        var obj = JSON.stringify({ firstn: fname.value, lastn: lname.value, email: email.value, gender: gender.value, mobile: mobile.value });
        var url = base_url + "?req=add&object=" + obj;
        var show = document.getElementById('showon');
        show.style.display = "block";

        $.get(url, function(data, success) {
            if (data != "Form successfully submitted") {
                show.innerHTML = "Try Again...Form not submitted Successfully!!!";
            } else {
                show.innerHTML = "Form submitted Successfully!!!";
            }
        })
        fillIt();
        document.querySelector('.regForm').reset();
    }
});

$(document).on('click', '#update', fillIt);