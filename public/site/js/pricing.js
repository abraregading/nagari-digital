document.addEventListener('DOMContentLoaded', () => {
  initPricingToggle();
  initFaqAccordion();
});

function initPricingToggle() {
  const toggleBtns = document.querySelectorAll('.pricing-toggle__btn');
  const cards = document.querySelectorAll('.pricing-card');

  if (!toggleBtns.length || !cards.length) return;

  toggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      toggleBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const period = btn.getAttribute('data-period');
      const multiplier = period === 'tahunan' ? 12 : period === '6bulan' ? 6 : 1;
      const periodLabel = period === 'tahunan' ? '/tahun' : period === '6bulan' ? '/6 bulan' : '/bulan';

      cards.forEach(card => {
        const amountEl = card.querySelector('.pricing-card__amount');
        const periodEl = card.querySelector('.pricing-card__period');

        if (!amountEl || !periodEl) return;

        const monthly = parseInt(amountEl.getAttribute('data-monthly'));
        if (!monthly) return;

        const total = monthly * multiplier;
        const fmt = total.toLocaleString('id-ID');

        amountEl.style.opacity = '0';
        amountEl.style.transform = 'translateY(-10px)';

        setTimeout(() => {
          amountEl.textContent = fmt;
          periodEl.textContent = periodLabel;
          amountEl.style.opacity = '1';
          amountEl.style.transform = 'translateY(0)';
        }, 200);
      });
    });
  });
}

function initFaqAccordion() {
  const faqItems = document.querySelectorAll('.faq__item');

  faqItems.forEach(item => {
    const question = item.querySelector('.faq__question');
    const answer = item.querySelector('.faq__answer');
    const toggle = item.querySelector('.faq__toggle i');

    if (!question || !answer) return;

    question.addEventListener('click', () => {
      const isOpen = item.classList.contains('faq__item--open');

      faqItems.forEach(otherItem => {
        otherItem.classList.remove('faq__item--open');
        const otherAnswer = otherItem.querySelector('.faq__answer');
        const otherToggle = otherItem.querySelector('.faq__toggle i');
        if (otherAnswer) otherAnswer.style.maxHeight = null;
        if (otherToggle) {
          otherToggle.classList.remove('fa-minus');
          otherToggle.classList.add('fa-plus');
        }
        const otherQuestion = otherItem.querySelector('.faq__question');
        if (otherQuestion) otherQuestion.setAttribute('aria-expanded', 'false');
      });

      if (!isOpen) {
        item.classList.add('faq__item--open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        if (toggle) {
          toggle.classList.remove('fa-plus');
          toggle.classList.add('fa-minus');
        }
        question.setAttribute('aria-expanded', 'true');
      }
    });
  });
}
