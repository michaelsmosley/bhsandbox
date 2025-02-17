(function () {
    const blog = document.querySelector('.aim__blog');

    if(blog) {
        const categoryCheckboxes                = document.querySelectorAll('.aim__blog__articles__category-checkbox');
        const tagCheckboxes                     = document.querySelectorAll('.aim__blog__articles__tag-checkbox');
        const searchInput                       = document.getElementById('aim__blog__articles__search-input');
        const clearTagsAndCategoriesBtn         = document.getElementById('aim__blog__articles__clear');
        const clearSearchBtn                    = document.getElementById('aim__blog__articles__search-clear');

        function applyURLParams() {
            const urlParams = new URLSearchParams(window.location.search);

            // Categories
            const categoriesParam = urlParams.get('categories');
            categoryCheckboxes.forEach(cb => cb.checked = false);
            if (categoriesParam) {
                const catIds = categoriesParam.split(',');
                categoryCheckboxes.forEach(cb => {
                    if (catIds.includes(cb.dataset.categoryId)) {
                        cb.checked = true;
                    }
                });
            }

            // Tags
            const tagsParam = urlParams.get('tags');
            tagCheckboxes.forEach(cb => cb.checked = false);
            if (tagsParam) {
                const tagIds = tagsParam.split(',');
                tagCheckboxes.forEach(cb => {
                    if (tagIds.includes(cb.dataset.tagId)) {
                        cb.checked = true;
                    }
                });
            }

            // Search
            const sParam = urlParams.get('s');
            if (searchInput) {
                searchInput.value = sParam ? sParam : '';
            }
        }

        function updateURLParams() {
            const selectedCats = [];
            categoryCheckboxes.forEach(cb => {
                if (cb.checked) {
                    selectedCats.push(cb.dataset.categoryId);
                }
            });

            const selectedTags = [];
            tagCheckboxes.forEach(cb => {
                if (cb.checked) {
                    selectedTags.push(cb.dataset.tagId);
                }
            });

            const searchTerm = searchInput ? searchInput.value.trim() : '';
            const url = new URL(window.location);
            url.searchParams.set('paged', '1');
            if (selectedCats.length > 0) {
                url.searchParams.set('categories', selectedCats.join(','));
            } else {
                url.searchParams.delete('categories');
            }

            if (selectedTags.length > 0) {
                url.searchParams.set('tags', selectedTags.join(','));
            } else {
                url.searchParams.delete('tags');
            }

            if (searchTerm !== '') {
                url.searchParams.set('s', searchTerm);
            } else {
                url.searchParams.delete('s');
            }

            window.location = url.toString();
        }

        function clearTagsAndCategories() {
            tagCheckboxes.forEach(cb => (cb.checked = false));
            categoryCheckboxes.forEach(cb => (cb.checked = false));
            updateURLParams();
        }

        function clearSearch() {
            if (searchInput) {
                searchInput.value = '';
            }
            updateURLParams();
        }

        function updateClearSearchBtn(){
            if(searchInput.value.length) {
                clearSearchBtn.classList.add('aim__blog__articles__search-clear--show');
            } else {
                clearSearchBtn.classList.remove('aim__blog__articles__search-clear--show');
            }
        }

        function initEventListeners() {
            categoryCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateURLParams);
            });
            tagCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateURLParams);
            });

            if (clearTagsAndCategoriesBtn) {
                clearTagsAndCategoriesBtn.addEventListener('click', clearTagsAndCategories);
            }
            if (clearSearchBtn) {
                clearSearchBtn.addEventListener('click', clearSearch);
            }

            updateClearSearchBtn();

            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    updateClearSearchBtn();
                });

                searchInput.addEventListener('keyup', (e) => {
                    if(e.key === 'Enter') {
                        updateURLParams();
                    }
                });
            }

            window.addEventListener('popstate', applyURLParams);

            const toggleButton = document.getElementById('toggleMobileFiltersButton');
            const toggleContent = document.getElementById('toggleMobileFiltersContent');
            toggleButton.addEventListener('click', function() {
                toggleContent.classList.toggle('aim__blog__articles__toggle-content--active');
            });
        }
        applyURLParams();

        document.addEventListener('DOMContentLoaded', function() {
            initEventListeners();
        });
    }
})();
