function welcomeMessage(){

    alert("Welcome to the Student Grading System!");

}

function confirmLogout(){

    return confirm("Are you sure you want to logout?");

}

function showDate(){

    let today = new Date();

    alert(today.toLocaleString());

}

function searchTable(){

    let input = document.getElementById("search");

    let filter = input.value.toUpperCase();

    let table = document.getElementById("gradeTable");

    let tr = table.getElementsByTagName("tr");

    for(let i=1;i<tr.length;i++){

        let td = tr[i].getElementsByTagName("td")[0];

        if(td){

            let txt = td.textContent || td.innerText;

            if(txt.toUpperCase().indexOf(filter) > -1){

                tr[i].style.display="";

            }else{

                tr[i].style.display="none";

            }

        }

    }

}

console.log("Student Grading System Loaded Successfully.");
