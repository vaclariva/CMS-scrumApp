/**
 * Removes the 'd-none' class from the specified element.
 *
 * @param {Object} el - The element to show.
 */
function showElement({ el }) {
    el.removeClass("hidden");
}

/**
 * Adds the 'd-none' class from the specified element.
 *
 * @param {Object} el - The element to show.
 */
function hideElement({ el }) {
    el.addClass("hidden");
}