const toggleBtn = document.querySelector('.toggle-btn')
const toggleBtnIcon = document.querySelector('.toggle-btn i')
const dropDownBtn = document.querySelector('.dropdown-menu')

toggleBtn.onclick =  function() {
    dropDownBtn.classList.toggle('open')
    const isOpen = dropDownBtn.classList.contains('open')

    toggleBtnIcon.classList = isOpen
    ? 'fa-solid fa-xmark'
    : 'fa-solid fa-bars'
}

function openModal() {
    document.getElementById('loginModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('loginModal').style.display = 'none';
}

function submitLoginForm() {
    console.log('Login button clicked');
}