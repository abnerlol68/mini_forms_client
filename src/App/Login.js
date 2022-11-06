/*==== At the moment don't need or can't use this modules ====*/

import Controller from '../Controller/Login.js';

document.addEventListener('DOMContentLoaded', function () {
  const ctrl = new Controller();
  const url = document.getElementById('url');
  const form = document.getElementById('form');
  const submit = document.getElementById('submit');
  const email = document.getElementById('email');

  submit.addEventListener('click', async function (event) {
    event.preventDefault();
    
    if (!email.value) {
      alert('Los ingrese un correo valido');
      return;
    }

    sessionStorage.setItem('user', email.value);
    console.log(sessionStorage);

    const answers = await ctrl.getAnswerIfExits(url.innerText, email.value);

    if (answers.length > 0) {
      location.href = `${url.innerText}thanks`;
      return;
    }
  });
});
