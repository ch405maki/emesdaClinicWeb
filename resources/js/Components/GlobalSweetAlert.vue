    <template>
        <!-- This component is invisible, it simply exposes methods for triggering alerts -->
    </template>
    
    <script setup>
    import Swal from 'sweetalert2';
    
    // Export methods to show different types of alerts
    export function showAlert(title, text, icon = 'info') {
        return Swal.fire({
        title,
        text,
        icon,
        confirmButtonText: 'OK'
        });
    }
    
    export function showSuccessAlert(title, text) {
        return showAlert(title, text, 'success');
    }
    
    export function showErrorAlert(title, text) {
        return showAlert(title, text, 'error');
    }
    </script>
    