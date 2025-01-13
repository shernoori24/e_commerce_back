document.getElementById('loginForm').addEventListener('submit', function(event){

    event.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('motDePasse').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'connexion/login', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if (xhr.status === 200) {

            document.getElementById('message').innerText = xhr.responseText;

        }else if (xhr.status === 401) {

            console.log(xhr)
            console.log(xhr.responseText);
            document.getElementById('message').innerText = 'js Mot de passe ou email incorrect';
             
        }else{

            document.getElementById('message').innerText = 'js error lors e la connexion.'
        
        }
    }
    xhr.send(`email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`);

});