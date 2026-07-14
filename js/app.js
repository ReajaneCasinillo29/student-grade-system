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

// ── Login page enhancements ───────────────────────────────────────────────

/**
 * 1. Show / Hide password toggle
 */
function togglePassword(){
    var field  = document.getElementById('password');
    var btn    = document.getElementById('toggleBtn');
    if(!field) return;

    if(field.type === 'password'){
        field.type = 'text';
        btn.innerHTML = '&#128683;'; // crossed-out eye
        btn.title = 'Hide password';
    } else {
        field.type = 'password';
        btn.innerHTML = '&#128065;'; // eye
        btn.title = 'Show password';
    }
}

/**
 * 2. Client-side validation with real-time feedback
 */
function validateField(id, errorId, groupId){
    var field = document.getElementById(id);
    var errEl = document.getElementById(errorId);
    var group = document.getElementById(groupId);
    if(!field) return true;

    var value = field.value.trim();
    var msg   = '';

    if(id === 'username'){
        if(value.length === 0)      msg = 'Username is required.';
        else if(value.length < 3)   msg = 'Username must be at least 3 characters.';
    }

    if(id === 'password'){
        if(value.length === 0)      msg = 'Password is required.';
        else if(value.length < 4)   msg = 'Password must be at least 4 characters.';
    }

    if(errEl) errEl.textContent = msg;
    if(group){
        if(msg) group.classList.add('has-error');
        else    group.classList.remove('has-error');
    }

    return msg === '';
}

// Attach real-time blur validation once the DOM is ready
document.addEventListener('DOMContentLoaded', function(){
    ['username', 'password'].forEach(function(id){
        var field = document.getElementById(id);
        if(field){
            field.addEventListener('blur', function(){
                validateField(id, 'error-' + id, 'group-' + id);
            });
            // Clear error as user types
            field.addEventListener('input', function(){
                var errEl = document.getElementById('error-' + id);
                var group = document.getElementById('group-' + id);
                if(errEl) errEl.textContent = '';
                if(group) group.classList.remove('has-error');
            });
        }
    });
});

/**
 * 3. Handle submit: validate + show loading state
 */
function handleSubmit(form){
    var usernameOk = validateField('username', 'error-username', 'group-username');
    var passwordOk = validateField('password', 'error-password', 'group-password');

    if(!usernameOk || !passwordOk) return false;

    // 5. Loading state on the button
    var btn     = document.getElementById('loginBtn');
    var btnText = document.getElementById('btnText');
    var spinner = document.getElementById('btnSpinner');

    if(btn && btnText && spinner){
        btn.disabled       = true;
        btnText.textContent = 'Logging in...';
        spinner.style.display = 'inline-block';
    }

    return true; // allow form to submit
}

console.log("Student Grading System Loaded Successfully.");
