document.getElementById('applyFilters').addEventListener('click', function () {
    const formData = new FormData(document.getElementById('filterForm'));

    fetch('', { method: 'POST', body: formData })
        .then(response => response.text())
        .then(html => {
            // Replace the content of the properties div with the filtered results
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            const newProperties = tempDiv.querySelector('#properties');
            if (newProperties) {
                document.getElementById('properties').innerHTML = newProperties.innerHTML;
            } else {
                document.getElementById('properties').innerHTML = '<p>No properties found based on filters.</p>';
            }
        })
        .catch(error => console.error('Error:', error));
});
