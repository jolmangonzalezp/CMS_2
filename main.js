document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("form").addEventListener("submit", function(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let responseDiv = document.getElementById("response"); // Asegurarse de que existe

        fetch("server.php", { 
            method: "POST",
            body: formData
        })
        .then(response => response.json()) // Convertir directamente a JSON
        .then(data => {
            console.log("Respuesta del servidor:", data);
            responseDiv.innerHTML = `<p style="color: ${data.success ? 'green' : 'red'};">${data.message}</p>`;
        })
        .catch(error => console.error("Error:", error));
    });
});