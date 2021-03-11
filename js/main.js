let state = false;

const eyes = document.querySelectorAll(".fa-eye");

for(let eye of eyes){
    eye.addEventListener("click", function(){
        toggle(this);
    })
}

function toggle(eye)
{
    if(state)
    {
        document.querySelector("#password").setAttribute("type", "password");
        state = false;
        eye.style.color="rgb(207, 207, 207)";
    }

    else
    {
        document.querySelector("#password").setAttribute("type", "text");
        state = true;
        eye.style.color="#f46036";
    }
}