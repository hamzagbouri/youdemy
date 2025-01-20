function toggleModal(show) {
    const modal = document.getElementById('addCourseModal');
    modal.classList.toggle('hidden', !show);
}

function toggleContentField() {
    const type = document.getElementById('courseType').value;
    const textField = document.getElementById('textContentField');
    const videoField = document.getElementById('videoContentField');
    
    if (type === 'text') {
        textField.classList.remove('hidden');
        videoField.classList.add('hidden');
    } else if (type === 'video') {
        textField.classList.add('hidden');
        videoField.classList.remove('hidden');
    }
}

const courseTagsInput = document.getElementById('courseTags');
const tagsList = document.getElementById('tagsList');
const selectedTagsContainer = document.getElementById('selectedTags');
let selectedTags = [];

function fetchTags(query) {
    fetch(`../../app/actions/tag/getAllJson.php?query=${query}`)
        .then(response => response.json())
        .then(tags => {
            tagsList.innerHTML = '';
            tags.forEach(tag => {
                const tagItem = document.createElement('div');
                tagItem.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                tagItem.textContent = tag.titre;
                tagItem.setAttribute('data-id', tag.id);
                tagItem.setAttribute('data-name', tag.titre);
                tagsList.appendChild(tagItem);
                tagItem.addEventListener('click', function () {
                    addTag(tag);
                });
            });
            tagsList.classList.remove('hidden');
        });
}

function addTag(tag) {
    if (!selectedTags.some(t => t.id === tag.id || t.titre.toLowerCase() === tag.titre.toLowerCase())) {
        selectedTags.push(tag);
        updateSelectedTags();
       
    }
    courseTagsInput.value = ''; 
    tagsList.classList.add('hidden'); 
}

function removeTag(tag) {
    selectedTags = selectedTags.filter(t => t.id !== tag.id);
    console.log(selectedTags)
    updateSelectedTags();
}

function updateSelectedTags() {
    selectedTagsContainer.innerHTML = '';
    selectedTags.forEach(tag => {
        const tagElement = document.createElement('div');
        tagElement.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-1', 'rounded-full', 'flex', 'items-center', 'gap-2');
        tagElement.textContent = tag.titre;
        const removeIcon = document.createElement('span');
        removeIcon.textContent = '×';
        removeIcon.classList.add('cursor-pointer');
        removeIcon.addEventListener('click', () => removeTag(tag));
        tagElement.appendChild(removeIcon);
        selectedTagsContainer.appendChild(tagElement);
    });
    
}

courseTagsInput.addEventListener('input', function () {
    const query = courseTagsInput.value.trim();
    if (query.length >= 1) {
        fetchTags(query);
    } else {
        tagsList.classList.add('hidden');
    }
});

courseTagsInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && courseTagsInput.value.trim() !== '') {
        e.preventDefault(); 
        const newTag = { id: 'new' + selectedTags.length, titre: courseTagsInput.value.trim() };
        addTag(newTag);
    }
});
document.getElementById('addCourseForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('selectedTags', JSON.stringify(selectedTags));
    fetch('/Youdemy/app/actions/cours/add.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json(); 
    })
    .then(data => {
        console.log(data); 
         window.location.href ='cours.php'
   
    })
    .catch(error => {
        console.error('Error occurred:', error);
        alert(`An unexpected error occurred: ${error.message}`);
    });
    
});
// Open the modal and populate course data



