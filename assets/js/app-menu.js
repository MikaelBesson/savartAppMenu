

let selection = document.querySelectorAll('.select');
console.log(selection);
selection.forEach(el => {
    el.addEventListener('click', ()=> {
        alert('click ok');
        console.log('ok');
    })
});








