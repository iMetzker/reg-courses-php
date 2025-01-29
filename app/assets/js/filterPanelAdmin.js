document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInputCourses");
    const coursesContainer = document.getElementById("all-courses");
    const tableHead = coursesContainer.querySelector("thead");
    const courseRows = Array.from(coursesContainer.getElementsByTagName("tr"));
    const noResultsMessage = document.getElementById("noResult");
  
    function applyFilters() {
      const searchText = searchInput.value.toLowerCase();
  
      let filteredCourses = 0;
  
      // FILTRA SOMENTE AS LINHAS
      courseRows.forEach((row) => {
        const courseNameElement = row.querySelector(".heading");
        
        // VERIFICA CADA LINHA
        if (courseNameElement) {
          const courseName = courseNameElement.textContent.toLowerCase();
  
          if (courseName.includes(searchText)) {
            row.style.display = "";
            filteredCourses++;
          } else {
            row.style.display = "none";
          }
        }
      });
  
      if (!filteredCourses) {
        noResultsMessage.classList.remove("d-none");
        tableHead.style.display = "none";
      } else {
        noResultsMessage.classList.add("d-none");
        tableHead.style.display = "";
      }
    }
  
    searchInput.addEventListener("input", applyFilters);
  });