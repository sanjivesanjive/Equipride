$(document).ready(function() {
    console.log("Second search bar JavaScript code is executing.");
    // Function to fetch related products
    function fetchProducts($searchInput, $searchResults) {
        $searchResults.hide();

        $searchInput.on("input", function() {
            const query = $searchInput.val().trim();

            if (query === '') {
                $searchResults.hide();
            } else {
                $.ajax({
                    type: "POST",
                    url: "search_user.php",
                    data: { query: query },
                    dataType: "json",
                    success: function(data) {
                        $searchResults.empty();

                        if (data.length === 0) {
                            $searchResults.html("<div>No match found for " + query + "</div>");
                        } else {
                            data.forEach(function(product) {
                                const productDiv = $("<div>").text(product.name);
                                productDiv.click(function() {
                                    $searchInput.val(product.name);
                                    const productDetailsURL = "product_details_user.php?id=" + product.id + "&product_id=" + product.product_id;
                                    $searchInput.val('');
                                    window.location.href = productDetailsURL;
                                });
                                $searchResults.append(productDiv);
                            });
                            $searchResults.show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error status: " + status);
                        console.error("Error message: " + error);
                    }
                });
            }
        });

        $searchResults.on("mouseleave", function() {
            $searchResults.hide();
            $searchInput.val('');
        });
    }

    // Call the function for the first search bar
    const $searchInput1 = $("#search-input");
    const $searchResults1 = $("#search-results");
    fetchProducts($searchInput1, $searchResults1);

    // Call the function for the second search bar
    const $searchInput2 = $("#responsive-search-input");
    const $searchResults2 = $("#responsive-search-results");
    fetchProducts($searchInput2, $searchResults2);
});