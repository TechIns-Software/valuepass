// We collect all categories id from elements where in div with id experiences

const experiencesElements = [...document.getElementById('experiences').children];
const storesCategory = [];
const storesIdElement = []
for (let ccc = 1; ccc <= experiencesElements.length; ccc++) {
    storesCategory.push($(`#exper${ccc}`).attr('data-category'));
    // storesIdElement.push(`exper${ccc}`)
}

experiencesElements.forEach(element => {
    storesIdElement.push(element.id)
});

// console.log("This is all category experiences ids");
console.log(storesIdElement);


