/**
 * Controller principal js
 *
 * @author Jônatas Ramos
 */

/**
 * Main Controller
 */
const Main = {
    /**
     * Abre uma tag passada por parâmetro
     */
    open: (item) => {
        $(item).show();
    },
    /**
     * Fecha uma tag passada por parâmetro
     */
    close: (item) => {
        $(item).hide();
    }
}
