const select = document.querySelector('#category-chooser');
const tableElements = document.querySelectorAll('table.table_box tr');

select.addEventListener('change', e => {
   const option = select.options[select.options.selectedIndex];

   // Reset des TR pour les rendre à nouveau tous visibles.
    tableElements.forEach(tr => {
        console.log(tr.style.display);
        tr.style.display = ''
    });

   // Masque les tr qui ne correspondent pas au critère.
   if(option.value.toLowerCase() !== 'no-filter') {
       // L'utilisateur a choisi une catégorie.
       tableElements.forEach(tr => {
           if(!tr.innerText.toLowerCase().includes(option.value.toLowerCase())) {
               tr.style.display = 'none';
           }
       });
   }
});
