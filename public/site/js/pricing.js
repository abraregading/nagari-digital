/* =============================================
   PRICING PAGE — JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {
  initPricingToggle();
  initFaqAccordion();
});

/* --- Pricing Period Toggle --- */
function initPricingToggle() {
  const toggleBtns = document.querySelectorAll('.pricing-toggle__btn');
  const priceAmount = document.getElementById('priceAmount');
  const pricePeriod = document.getElementById('pricePeriod');
  const priceSavings = document.getElementById('priceSavings');

  if (!toggleBtns.length || !priceAmount) return;

  const pricing = {
    bulanan: {
      amount: '450.000',
      period: '/bulan',
      savings: ''
    },
    '6bulan': {
      amount: '2.250.000',
      period: '/6 bulan',
      savings: '<i class="fa-solid fa-piggy-bank"></i> Hemat Rp 450.000 dibanding bulanan'
    },
    tahunan: {
      amount: '4.000.000',
      period: '/tahun',
      savings: '<i class="fa-solid fa-fire"></i> Hemat Rp 1.400.000 dibanding bulanan'
    }
  };

  toggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      // Update active state
      toggleBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const period = btn.getAttribute('data-period');
      const data = pricing[period];

      if (!data) return;

      // Animate price change
      priceAmount.style.opacity = '0';
      priceAmount.style.transform = 'translateY(-10px)';

      setTimeout(() => {
        priceAmount.textContent = data.amount;
        pricePeriod.textContent = data.period;

        if (priceSavings) {
          priceSavings.innerHTML = data.savings;
          priceSavings.classList.toggle('pricing-card__savings--visible', data.savings !== '');
        }

        priceAmount.style.opacity = '1';
        priceAmount.style.transform = 'translateY(0)';
      }, 200);
    });
  });
}

/* --- FAQ Accordion --- */
function initFaqAccordion() {
  const faqItems = document.querySelectorAll('.faq__item');

  faqItems.forEach(item => {
    const question = item.querySelector('.faq__question');
    const answer = item.querySelector('.faq__answer');
    const toggle = item.querySelector('.faq__toggle i');

    if (!question || !answer) return;

    question.addEventListener('click', () => {
      const isOpen = item.classList.contains('faq__item--open');

      // Close all items
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

      // Open clicked item if it was closed
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
