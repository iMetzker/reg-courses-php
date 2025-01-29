document.addEventListener("DOMContentLoaded", function () {
    const orderSelect = document.getElementById("orderSelect");
    const coursesContainer = document.getElementById("coursesContainer");
  
    orderSelect.addEventListener("change", function () {
      const selectedOption = orderSelect.value;
      const courses = Array.from(coursesContainer.getElementsByClassName("course-card"));
  
      let sortedCourses;
  
      if (selectedOption === "date") {
        // CURSOS MAIS RECENTES
        
        sortedCourses = courses.sort((a, b) => {
          const dateA = new Date(a.getAttribute("data-date"));
          const dateB = new Date(b.getAttribute("data-date"));
          return dateA - dateB;
        });
      } else if (selectedOption === "open") {
        // ORDENANDO CURSOS ABERTOS E COLOCANDO COM PRIORIDADE MAIS VAGAS

        sortedCourses = courses.sort((a, b) => {
          const vacanciesA = parseInt(a.getAttribute("data-vacancies"));
          const vacanciesB = parseInt(b.getAttribute("data-vacancies"));
          return vacanciesB - vacanciesA;
        });
      } else {
        // ORDEM ORIGINAL

        sortedCourses = courses;
      }
  
      coursesContainer.innerHTML = "";
      sortedCourses.forEach(course => {
        coursesContainer.appendChild(course);
      });
    });
  });