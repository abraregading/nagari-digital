/* =============================================
   KONTAK PAGE — JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {
  initContactForm();
  initFaqAccordion();
  initSelectFloat();
});

/* --- Contact Form Validation & Submit --- */
function initContactForm() {
  const form = document.getElementById('kontakForm');
  const submitBtn = document.getElementById('submitBtn');
  const formSuccess = document.getElementById('formSuccess');
  const resetFormBtn = document.getElementById('resetFormBtn');

  if (!form) return;

  // Real-time validation on input
  const fieldsToValidate = ['nama', 'whatsapp', 'nagari'];
  fieldsToValidate.forEach(fieldId => {
    const input = document.getElementById(fieldId);
    if (input) {
      input.addEventListener('input', () => {
        clearFieldError(fieldId);
        // Live phone format validation
        if (fieldId === 'whatsapp' && input.value.trim()) {
          validatePhoneFormat(input.value.trim(), false);
        }
      });

      input.addEventListener('blur', () => {
        if (input.value.trim()) {
          if (fieldId === 'whatsapp') {
            validatePhoneFormat(input.value.trim(), true);
          }
        }
      });
    }
  });

  // Email live validation
  const emailInput = document.getElementById('email');
  if (emailInput) {
    emailInput.addEventListener('blur', () => {
      if (emailInput.value.trim() && !isValidEmail(emailInput.value.trim())) {
        setFieldError('email', 'Format email tidak valid');
      } else {
        clearFieldError('email');
      }
    });
    emailInput.addEventListener('input', () => clearFieldError('email'));
  }

  // Form submission
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    // Reset all errors
    clearAllErrors();

    // Get values
    const nama = document.getElementById('nama').value.trim();
    const email = document.getElementById('email').value.trim();
    const whatsapp = document.getElementById('whatsapp').value.trim();
    const nagari = document.getElementById('nagari').value.trim();
    const paket = document.getElementById('paket').value;
    const pesan = document.getElementById('pesan').value.trim();

    // Validate
    let hasError = false;

    if (!nama) {
      setFieldError('nama', 'Nama lengkap wajib diisi');
      hasError = true;
    } else if (nama.length < 3) {
      setFieldError('nama', 'Nama minimal 3 karakter');
      hasError = true;
    }

    if (email && !isValidEmail(email)) {
      setFieldError('email', 'Format email tidak valid');
      hasError = true;
    }

    if (!whatsapp) {
      setFieldError('whatsapp', 'Nomor WhatsApp wajib diisi');
      hasError = true;
    } else if (!isValidPhone(whatsapp)) {
      setFieldError('whatsapp', 'Nomor tidak valid (gunakan format: 08xx atau +628xx)');
      hasError = true;
    }

    if (!nagari) {
      setFieldError('nagari', 'Nama Nagari/Desa wajib diisi');
      hasError = true;
    } else if (nagari.length < 3) {
      setFieldError('nagari', 'Nama Nagari/Desa minimal 3 karakter');
      hasError = true;
    }

    if (hasError) {
      // Scroll to first error
      const firstError = form.querySelector('.kontak-form__input-wrap.error');
      if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      return;
    }

    // Show loading state
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;

    // Build WhatsApp message
    const paketText = paket || 'Belum dipilih';
    const pesanText = pesan || '(tidak ada pesan tambahan)';

    const waMessage = `Halo Nagari Digital!

Nama: ${nama}
Email: ${email || '(tidak diisi)'}
WhatsApp: ${whatsapp}
Nagari: ${nagari}
Paket: ${paketText}

Pesan:
${pesanText}`;

    // Submit to server
    const csrfToken = form.querySelector('[name="_token"]')?.value;
    if (csrfToken) {
      fetch(form.action, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ nama, email, whatsapp, nagari, paket: paket || '', pesan: pesan || '' })
      }).catch(() => {});
    }

    // Short delay for UX feel
    setTimeout(() => {
      // Show success state
      form.style.display = 'none';
      formSuccess.classList.add('active');

      // Reset loading
      submitBtn.classList.remove('loading');
      submitBtn.disabled = false;

      // Open WhatsApp
      const waUrl = `https://wa.me/6282284186104?text=${encodeURIComponent(waMessage)}`;
      window.open(waUrl, '_blank');
    }, 800);
  });

  // Reset form
  if (resetFormBtn) {
    resetFormBtn.addEventListener('click', () => {
      form.reset();
      formSuccess.classList.remove('active');
      form.style.display = '';
      clearAllErrors();

      // Reset select float label
      const selectWrap = form.querySelector('.kontak-form__input-wrap--select');
      if (selectWrap) selectWrap.classList.remove('has-value');
    });
  }
}

/* --- Validation helpers --- */
function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isValidPhone(phone) {
  // Accept formats: 08xx, +628xx, 628xx, with 9-15 digits total
  const cleaned = phone.replace(/[\s\-\(\)]/g, '');
  return /^(\+?62|0)[0-9]{8,13}$/.test(cleaned);
}

function validatePhoneFormat(value, showError) {
  const cleaned = value.replace(/[\s\-\(\)]/g, '');
  if (cleaned.length > 3 && !isValidPhone(cleaned) && showError) {
    setFieldError('whatsapp', 'Format nomor: 08xx atau +628xx');
    return false;
  }
  return true;
}

function setFieldError(fieldId, message) {
  const input = document.getElementById(fieldId);
  const errorEl = document.getElementById(fieldId + 'Error');
  const wrap = input?.closest('.kontak-form__input-wrap');

  if (wrap) wrap.classList.add('error');
  if (errorEl) {
    errorEl.textContent = message;
    errorEl.classList.add('visible');
  }
}

function clearFieldError(fieldId) {
  const input = document.getElementById(fieldId);
  const errorEl = document.getElementById(fieldId + 'Error');
  const wrap = input?.closest('.kontak-form__input-wrap');

  if (wrap) wrap.classList.remove('error');
  if (errorEl) {
    errorEl.textContent = '';
    errorEl.classList.remove('visible');
  }
}

function clearAllErrors() {
  document.querySelectorAll('.kontak-form__input-wrap.error').forEach(el => {
    el.classList.remove('error');
  });
  document.querySelectorAll('.kontak-form__error').forEach(el => {
    el.textContent = '';
    el.classList.remove('visible');
  });
}

/* --- Select floating label fix --- */
function initSelectFloat() {
  const select = document.getElementById('paket');
  if (!select) return;

  const wrap = select.closest('.kontak-form__input-wrap');

  select.addEventListener('change', () => {
    if (select.value) {
      wrap.classList.add('has-value');
    } else {
      wrap.classList.remove('has-value');
    }
  });
}

/* --- FAQ Accordion --- */
function initFaqAccordion() {
  const faqItems = document.querySelectorAll('.kontak-faq__item');
  if (!faqItems.length) return;

  faqItems.forEach(item => {
    const question = item.querySelector('.kontak-faq__question');
    if (!question) return;

    question.addEventListener('click', () => {
      const isActive = item.classList.contains('active');

      // Close all items
      faqItems.forEach(otherItem => {
        otherItem.classList.remove('active');
        const btn = otherItem.querySelector('.kontak-faq__question');
        if (btn) btn.setAttribute('aria-expanded', 'false');
      });

      // Open clicked item if it was closed
      if (!isActive) {
        item.classList.add('active');
        question.setAttribute('aria-expanded', 'true');
      }
    });
  });
}
