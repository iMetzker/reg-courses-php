document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const coursesContainer = document.getElementById("coursesContainer");
  const courseCards = Array.from(
    coursesContainer.getElementsByClassName("course-card")
  );

  function applyFilters() {
    const searchText = searchInput.value.toLowerCase();

    const filteredCourses = courseCards.filter((course) => {
      const courseName = course
        .querySelector(".heading a")
        .textContent.toLowerCase();
      return courseName.includes(searchText);
    });

    // RESETANDO O CARD E ADICIONANDO APENAS OS CURSOS FILTRADOS
    coursesContainer.innerHTML = "";
    
    // VERIFICANDO SE NAO HÁ CURSOS
    if (!filteredCourses.length) {
      const noResultsMessage = document.getElementById("noResult");
      noResultsMessage.classList.remove("d-none");
      // coursesContainer.appendChild(noResultsMessage);
    }
      else {
       filteredCourses.forEach((course) => {
         coursesContainer.appendChild(course);
       });
        noResultsMessage.classList.add("d-none");
     }
  }

  searchInput.addEventListener("input", applyFilters);
});