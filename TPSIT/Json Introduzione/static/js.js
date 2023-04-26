let users = [];

function handleSubmit(event) {
  event.preventDefault();
  let name = document.querySelector('#name').value;
  let surname = document.querySelector('#surname').value;
  let age = document.querySelector('#age').value;
  let gender = document.querySelector('#gender').value;
  let user = { name, surname, age, gender };
  users.push(user);
  printUsers();
}

function printUsers() {
  console.log(users);
}

document.querySelector('#submit').addEventListener('click', handleSubmit);