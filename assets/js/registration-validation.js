/**
 * Registration Form Validation Handler
 *
 * Client-side validation for registration interest form.
 *
 * @package Novira_Academy
 */

(function() {
    'use strict';

    /**
     * Validate email format
     */
    function isValidEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    /**
     * Validate phone format (Egyptian numbers)
     */
    function isValidPhone(phone) {
        var re = /^(\+20|0)?1[0125]\d{8}$/;
        return re.test(phone.replace(/\s/g, ''));
    }

    /**
     * Show error message
     */
    function showError(field, message) {
        var errorEl = field.parentNode.querySelector('.field-error');
        if (!errorEl) {
            errorEl = document.createElement('span');
            errorEl.className = 'field-error';
            errorEl.setAttribute('role', 'alert');
            field.parentNode.appendChild(errorEl);
        }
        errorEl.textContent = message;
        field.classList.add('error');
        field.setAttribute('aria-invalid', 'true');
    }

    /**
     * Clear error message
     */
    function clearError(field) {
        var errorEl = field.parentNode.querySelector('.field-error');
        if (errorEl) {
            errorEl.remove();
        }
        field.classList.remove('error');
        field.removeAttribute('aria-invalid');
    }

    /**
     * Validate a single field
     */
    function validateField(field) {
        var value = field.value.trim();
        var name = field.name;

        clearError(field);

        // Required fields
        if (field.hasAttribute('required') && !value) {
            showError(field, 'هذا الحقل مطلوب');
            return false;
        }

        // Email validation
        if (name === 'email' && value && !isValidEmail(value)) {
            showError(field, 'يرجى إدخال بريد إلكتروني صحيح');
            return false;
        }

        // Phone validation
        if (name === 'phone' && value && !isValidPhone(value)) {
            showError(field, 'يرجى إدخال رقم هاتف صحيح');
            return false;
        }

        // Age validation
        if (name === 'student_age' && value) {
            var age = parseInt(value);
            if (age < 5 || age > 18) {
                showError(field, 'يجب أن يكون عمر الطالب بين 5 و 18 سنة');
                return false;
            }
        }

        return true;
    }

    /**
     * Validate registration form
     */
    function validateRegistrationForm(form) {
        var fields = form.querySelectorAll('input, select, textarea');
        var isValid = true;

        fields.forEach(function(field) {
            if (!validateField(field)) {
                isValid = false;
            }
        });

        return isValid;
    }

    /**
     * Initialize form validation
     */
    function initFormValidation() {
        var form = document.getElementById('registration-interest-form');
        if (!form) return;

        // Real-time validation on blur
        var fields = form.querySelectorAll('input, select, textarea');
        fields.forEach(function(field) {
            field.addEventListener('blur', function() {
                validateField(this);
            });

            field.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (validateRegistrationForm(this)) {
                // Submit form via AJAX
                submitRegistrationForm(this);
            }
        });
    }

    /**
     * Submit registration form via AJAX
     */
    function submitRegistrationForm(form) {
        var formData = new FormData(form);
        var submitBtn = form.querySelector('button[type="submit"]');
        var originalText = submitBtn.innerHTML;

        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner"></span> جاري الإرسال...';

        fetch(noviraData.ajaxUrl, {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.success) {
                form.style.display = 'none';
                document.getElementById('reg-form-success').style.display = 'block';
            } else {
                alert(data.data.message || 'حدث خطأ أثناء الإرسال');
            }
        })
        .catch(function(error) {
            alert('حدث خطأ أثناء الإرسال');
        })
        .finally(function() {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFormValidation);
    } else {
        initFormValidation();
    }
})();
