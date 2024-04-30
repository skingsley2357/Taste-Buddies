'use strict';

document.addEventListener('DOMContentLoaded', function () {
  // Function to add ingredients dynamically
  var addButton = document.querySelector('button that calls addIngredient'); // Replace with your actual button selector
  if (addButton) {
      addButton.addEventListener('click', addIngredient);
  }
  

  // Scaling ingredients based on selected radio button
  const radios = document.querySelectorAll('input[type="radio"][name="scale"]');
  radios.forEach(radio => {
    radio.addEventListener('change', function () {
      updateIngredients(this.value);
    });
  });

  function updateIngredients(scale) {
    const ingredients = document.querySelectorAll('#recipe-flex li');
    ingredients.forEach(li => {
      if (li.innerHTML.includes('(')) {
        const originalText = li.getAttribute('data-original');
        if (!originalText) {
          li.setAttribute('data-original', li.innerHTML);
        }
        const baseText = originalText || li.innerHTML;
        const regex = /(\d+\.?\d*)/g;
        const newText = baseText.replace(regex, function (match) {
          return (parseFloat(match) * scale).toFixed(2).replace(/\.00$/, '');
        });
        li.innerHTML = newText;
      }
    });
  }

  // Sorting table columns
  const table = document.getElementById('recipes-table');
  if (table) {
    const headers = table.querySelectorAll('th');
    let rows = Array.from(table.querySelectorAll('tr')).slice(1);
    let originalRowsOrder = [...rows];
    let sortedColumn = -1;
    let sortDirection = 0;

    headers.forEach((header, index) => {
      header.addEventListener('click', () => {
        if (sortedColumn !== index) {
          sortDirection = 1;
          sortedColumn = index;
        } else {
          sortDirection = sortDirection === 1 ? -1 : (sortDirection === -1 ? 0 : 1);
        }
        sortTable(index, sortDirection);
        updateHeaderSortIndicators(headers, header, sortDirection);
      });
    });

    function sortTable(columnIndex, direction) {
      if (direction === 0) {
        table.append(...originalRowsOrder);
        rows = [...originalRowsOrder];
      } else {
        const multiplier = direction === 1 ? 1 : -1;
        rows.sort((a, b) => {
          const cellA = a.querySelectorAll('td')[columnIndex]?.textContent.trim() || '';
          const cellB = b.querySelectorAll('td')[columnIndex]?.textContent.trim() || '';
          return cellA.localeCompare(cellB, undefined, { numeric: true }) * multiplier;
        });
        table.append(...rows);
      }
    }

    function updateHeaderSortIndicators(headers, selectedHeader, direction) {
      headers.forEach(header => {
        header.classList.remove('sort-asc', 'sort-desc');
      });
      if (direction === 1) {
        selectedHeader.classList.add('sort-asc');
      } else if (direction === -1) {
        selectedHeader.classList.add('sort-desc');
      }
    }
  }

  // Filtering recipes based on dropdown selections
  const recipesTable = document.getElementById('recipes-table');
  if (recipesTable) {
    const filtersDiv = document.createElement('div');
    filtersDiv.id = 'filters';
    recipesTable.parentNode.insertBefore(filtersDiv, recipesTable);
    const difficulties = ['Easy', 'Medium', 'Hard'];
    const cuisineTypes = ['Italian', 'Mexican', 'Chinese', 'Indian', 'French'];
    const mealTypes = ['Breakfast', 'Lunch', 'Dinner', 'Snack'];

    const difficultySelect = createDropdown(difficulties, 'difficulty-select', 'Select Difficulty');
    const cuisineSelect = createDropdown(cuisineTypes, 'cuisine-select', 'Select Cuisine Type');
    const mealSelect = createDropdown(mealTypes, 'meal-select', 'Select Meal Type');

    [difficultySelect, cuisineSelect, mealSelect].forEach(select => {
      select.addEventListener('change', filterTable);
    });

    function createDropdown(options, id, placeholder) {
      const select = document.createElement('select');
      select.id = id;
      select.innerHTML = `<option value="">${placeholder}</option>` + options.map(option => `<option value="${option}">${option}</option>`).join('');
      filtersDiv.appendChild(select);
      return select;
    }

    function filterTable() {
      const difficulty = difficultySelect.value;
      const cuisine = cuisineSelect.value;
      const meal = mealSelect.value;
      const rows = document.querySelectorAll('#recipes-table tbody tr');
      rows.forEach(row => {
        const difficultyCell = row.cells[2].textContent;
        const cuisineCell = row.cells[3].textContent;
        const mealCell = row.cells[4].textContent;
        row.style.display = (
          (difficulty === '' || difficulty === difficultyCell) &&
          (cuisine === '' || cuisine === cuisineCell) &&
          (meal === '' || meal === mealCell)
        ) ? '' : 'none';
      });
    }
  }
});

function addIngredient() {
  var ingredientsList = document.getElementById('ingredientsList');
  var clonedIngredients = ingredientsList.cloneNode(true);
  var selects = clonedIngredients.getElementsByTagName('select');
  var inputs = clonedIngredients.getElementsByTagName('input');

  for (var i = 0; i < selects.length; i++) {
    selects[i].selectedIndex = 0;
  }
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type === 'text' || inputs[i].type === 'number') {
      inputs[i].value = '';
    } else if (inputs[i].type === 'checkbox' || inputs[i].type === 'radio') {
      inputs[i].checked = false;
    }
  }
  ingredientsList.parentNode.appendChild(clonedIngredients);
}

function searchRecipe() {
  // Declare variables
  let input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("recipes-table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0]; // Get the first column
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
