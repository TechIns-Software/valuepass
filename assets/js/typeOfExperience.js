var filterIdsCat = [];
var idCategory;

filterIdsCat = removeDuplicates(filterIdsCat);

function changeCategory(value, checked) {
    idCategory = value;

    //if user check the checkbox
    if (checked) {
        // not all
        if (idCategory != -1) {
            filterIdsCat.push(idCategory);
            filterIdsCat = removeDuplicates(filterIdsCat);
            displayAvailableCategories();
        } else {
            checkBoxesControl(1);
            filterIdsCat = removeDuplicates(storesCategory);
            displayAvailableCategories();
        }
    } else if (!checked) {
        //if user uncheck the checkbox
        if (idCategory != -1) {
            const index1 = filterIdsCat.indexOf(idCategory);
            if(index1  > -1){
                filterIdsCat.splice(index1, 1);
            }

            displayAvailableCategories();
        } else {
            checkBoxesControl(0);
            filterIdsCat = removeDuplicates(storesCategory);
            //displayAvailableCategories();
        }
    }
}

function displayAvailableCategories() {
    // I loop all the elements and i get the data-category value , if includes to filterIdsCat
    // array display if not displayNone
    for (let cc1 = 1; cc1 <= storesCategory.length; cc1++) {
        const elementShow = document.getElementById(`exper${cc1}`);
        const categoryVal =elementShow.getAttribute("data-category");

        //if no elements in array just display all the elements
        if (filterIdsCat.length === 0) {
            // filterIdsCat = removeDuplicates(storesCategory);
            elementShow.classList.remove("displayNone");
            continue;
        }

        if (idCategory !== -1) {
            if (filterIdsCat.includes(categoryVal)) {
                elementShow.classList.remove("displayNone");

            } else {
                elementShow.classList.add("displayNone");
            }
        }else {
            elementShow.classList.remove("displayNone");
        }
        console.log(filterIdsCat);
    }

}

function removeDuplicates(arr) {
    return arr.filter((item, index) => arr.indexOf(item) == index);

}

// Function to check or uncheck alla the chechboxes
function checkBoxesControl(val,fromAll) {
    const checkBoxInputs = document.querySelectorAll("input[type=checkbox]");

    if (val) {
        checkBoxInputs.forEach((element) => {
            element.checked = true;
        });
        filterIdsCat = removeDuplicates(storesCategory);
    } else {
        checkBoxInputs.forEach((element) => {
            element.checked = false;
        });
    }
}

