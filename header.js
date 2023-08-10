
var productArr = [];

document.addEventListener('DOMContentLoaded', function() {
    $(document).ready(function() {
        $('.nav-link').click(function() {
            $('.nav-link').removeClass('bold-link'); // Remove the class from all links
            $(this).addClass('bold-link'); // Add the class to the clicked link
        });
    });

    const setId =document.getElementById('productID');
    const searchInput = document.getElementById('searchInput');
    const autocompleteResults = document.getElementById('autocompleteResults');

    searchInput.addEventListener('input', function() {
        const query = searchInput.value;
        console.log(query);
        if (query.length > 0) {
            fetch(`Template/ajax.php?query=${encodeURIComponent(query)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status}`);
                    }
                    return response.json();
                })
                .then(products => {
                    productArr = products;
                    console.log(products);
                        autocompleteResults.innerHTML = ''; // Clear previous suggestions
                        products.forEach(product => {
                            const suggestionItem = document.createElement('li');
                            suggestionItem.textContent = product.name;
                            suggestionItem.classList.add('dropdown-item');
                            suggestionItem.addEventListener('click', function() {
                                searchInput.value = product.name;
                                setId.value=product.id;
                                // Redirect to product page with ProductID
                                window.location.href = `product.php?ProductID=${product.id}`;
                                autocompleteResults.style.display = 'none';
                            });
                            autocompleteResults.appendChild(suggestionItem);
                        });
                        autocompleteResults.style.display = 'block'; // Show dropdown

                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        } else {
            autocompleteResults.innerHTML = '';
            autocompleteResults.style.display = 'none'; // Hide dropdown
        }
    });

    document.addEventListener('click', function(event) {
        if (!searchInput.contains(event.target) && !autocompleteResults.contains(event.target)) {
            autocompleteResults.innerHTML = '';
            autocompleteResults.style.display = 'none'; // Hide dropdown
        }
    });

    //send data to search page
    const searchButton = document.getElementById('searchButton');

    searchButton.addEventListener('click', function() {
        const query = searchInput.value.trim();
        window.location.href = `search-result.php`;

        /*if (query.length > 0) {
            fetch(`Template/ajax.php?query=${encodeURIComponent(query)}`, {
                method: 'POST',
                headers: {
                    'Search-Items': 'application/json'
                },
                body: JSON.stringify({ query: query, products: productArr })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status}`);
                    }
                    //window.location.href = `search-result.php`;
                    return response.json();
                })
                .then(responseData => {
                    console.log(responseData); // Handle the response from PHP
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        } else {
            // Rest of your code for handling empty input
        }*/
    });
});
