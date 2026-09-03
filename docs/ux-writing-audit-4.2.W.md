# SPRINT 4.2.W — UX Writing System Audit

**Scope:** American Diploma Hub · EST · Digital SAT · ACT · Homepage · Navigation · CTAs · Cards · Hero · FAQs
**Model audited against:** Novira Academy's real service — *academic preparation for international exams* (assessment → choosing the exam → weekly classes with teachers → homework & practice → mock exams → continuous follow-up → registration support → travel support → official exam → highest possible score). University admission is **not** the service; it is downstream support that is factually offered (with a disclaimer) and must never be framed as the destination.

---

## 0. Executive summary

The codebase is **much healthier than a generic education site** and, in places, is already written in exactly the voice this sprint demands. The exam data layer (`inc/exams.php`), the diploma hero slide, the American Diploma hub landing, and the student-case section are model documentary, exam-prep copy. The `novira_admission_disclaimer()` primitive already kills admission/scholarship guarantees at the source.

The problems are concentrated and fixable, and fall into five buckets:

1. **A literal success guarantee** — the `مضمون` ("Guaranteed") seal on the homepage `why-novira` section. This is the single clearest violation of the brief and must be removed.
2. **University admission framed as the destination** — the EST page hero ("طريق أكاديمي متين نحو القبول الجامعي"), the hub's 7-stage journey climaxing at "الالتحاق بالجامعة", and the EST stepper ending at "التقديم الجامعي". Exams/score, not admission, are the climax.
3. **Future / career / "pathway" clichés bleeding onto exam surfaces** — "يخلّي مستقبلك في أمان", "تصنع مستقبلك", "بتبني مسارك... المهني", "دعم مهني وفرص وظيفية", "جاهز تبدأ مستقبلك؟".
4. **Legacy/broken files with truthfulness defects** — `department-american-diploma.php` states **Grade 1–12** (contradicts confirmed Grade 9–12), has typos ("ياعد", "الت interest", "الfall semester"), and admission-coaching framing. `trust-proof.php` ships **fabricated placeholder testimonials** and unverified "+500 طالب / +10 سنوات خبرة" badges.
5. **SAT & ACT are thin** — their override datasets in `inc/exams.php` are empty, so they inherit a generic base while EST has rich, honest, classroom-grounded copy. Not false — just incomplete. They should be brought up to EST's voice with facts left as `null` / `'contact'` until verified.

Everything else is aligned or a light touch. Detailed section-by-section audit follows. Scores are out of 10.

> **Scope note on the multi-department reality:** Novira genuinely runs three departments (Diploma exam prep, Certified Translation, Skills & Languages — see `PRODUCT.md`, `department-nav.php`). This audit does **not** recommend deleting those real services. It recommends that on **exam-prep surfaces** the copy stop borrowing the translation/skills department's career-and-future language, and that guarantee wording be removed everywhere.

---

## 1. Homepage

### 1.1 `why-novira.php` — the "مضمون" guarantee seal  ⚠️ highest priority

**Current copy**
- Seal/stamp: **`مضمون`** ("Guaranteed")
- Section desc: "نوفيرا أكاديمي مش مجرد أكاديمية تعليمية — دي مؤسسة بتبني مسارك الدراسي والمهني من البداية لحد ما توصل. بنؤمن إن التعليم الحقيقي هو اللي يخلّي مستقبلك في أمان."
- Guarantee 4: "دعم مهني مستمر — إرشاد مهني وفرص وظيفية حتى بعد ما تخلّص الكورس."
- Guarantee 2 body: "مش بس شيوخ تعليم — مدربين شغالين في سوق العمل وبيجيبوا الخبرة الحقيقية للفصل."

**Why it is inaccurate**
"مضمون" is a success guarantee — the brief explicitly forbids these, and the data layer already forbids them (`novira_admission_disclaimer`). "بتبني مسارك... المهني" and "فرص وظيفية" are career-services / professional-development promises, not what the Diploma exam-prep program delivers. "يخلّي مستقبلك في أمان" is a future-cliché. This section reads like a leadership/career academy, which the brief says Novira is not.

**New UX writing**
- Remove the `مضمون` seal. If a trust stamp is wanted, use the real one: **`معتمد من Cognia`**.
- Section title: `لماذا يدرس طلاب الدبلومة معنا`
- Section desc: `نوفيرا أكاديمي تُعِدّ طلاب الدبلومة الأمريكية أكاديمياً: حصص أسبوعية مع معلمين متخصصين، واجبات ومتابعة دورية بعد كل حصة، واختبارات تجريبية قبل الامتحان الرسمي — حتى يدخل طالبك قاعة الاختبار وهو مستعد فعلاً.`
- Replace the six "guarantees" with six **facts** already true of the program:
  1. `حصص أسبوعية مع معلمين متخصصين` — `دراسة منتظمة طوال العام، لا مراجعة في اللحظة الأخيرة.`
  2. `اعتماد دولي من Cognia` — `برنامج الدبلومة معتمد من Cognia، وهي أكبر هيئة دولية لاعتماد المؤسسات التعليمية.`
  3. `واجبات ومتابعة دورية` — `تمارين بعد كل حصة تكشف الثغرات مبكراً قبل أن تتراكم.`
  4. `اختبارات تجريبية قبل الامتحان` — `محاكاة ليوم الاختبار حتى لا يكون الامتحان الرسمي هو المرة الأولى.`
  5. `دعم في إجراءات التسجيل` — `نتولّى التسجيل للاختبار وترتيب الموعد ومتطلبات يوم الامتحان.`
  6. `تواصل مستمر مع ولي الأمر` — `تعرف دائماً أين يقف طالبك وما الخطوة التالية.`

**Reason for the change** Removes the forbidden guarantee, strips career/future framing, and replaces vague promises with the academy's real, observable working method.

**Business alignment:** 3/10 → 9/10 · **Truthfulness:** 4/10 → 9/10

---

### 1.2 `trust-proof.php` — fabricated placeholders  ⚠️ truthfulness

**Current copy** Three named testimonials ("سارة أحمد… غيّرت مسار حياتي", "محمد علي", "فاطمة خالد") and badges "مؤسسة معتمدة · +500 طالب · +10 سنوات خبرة" — all hardcoded fallbacks.

**Why it is inaccurate** These are invented people and unverified numbers. The homepage (`front-page.php`) already renders the **real** Google-reviews section (`testimonials-stitch.php`), so `trust-proof.php` is legacy. Shipping invented testimonials anywhere breaks the documentary/trust principle.

**New UX writing** Retire the section (do not enqueue it), or gate every field behind real, admin-entered data with **no fallback** (mirror the customizer's own rule: *"Leave any field empty to hide it. No placeholder or default data is ever shown."*). Numbers like "+500 طالب / +10 سنوات" should only appear if the academy confirms them.

**Business alignment:** 5/10 → 9/10 · **Truthfulness:** 2/10 → 10/10

---

### 1.3 `hero-stitch.php` slide 3 (Skills) & `cta.php` & testimonials CTA — future clichés

**Current copy**
- Slide 3: "مهارات ولغات تصنع مستقبلك" / "تخلّي أولادك سابقين سنهم"
- `cta.php`: "جاهز تبدأ مستقبلك؟"
- `testimonials-stitch` banner: "كن أنت التالي! انضم إلى طلابنا الذين يسعون لتحقيق أهدافهم."

**Why it is inaccurate** "تصنع مستقبلك / تبدأ مستقبلك" are future-ready clichés; "كن أنت التالي" is generic aspiration with no substance. (Slide 3 is the Skills department, which is real — the fix is tone, not removal.)

**New UX writing**
- Slide 3 heading: `لغات ومهارات بتدريب عملي` · desc: `كورسات لغات ومهارات رقمية في مجموعات صغيرة مع فريق تدريسي متخصص.`
- `cta.php` heading: `عندك سؤال عن البرنامج المناسب لطالبك؟` · desc: `تواصل معنا على واتساب وفريقنا يرد عليك ويرشّح لك الخطوة التالية.`
- Testimonials banner: `عايز نفس المتابعة لطالبك؟` · desc: `تواصل معنا نحدّد له البرنامج والاختبار المناسب.`

**Reason** Trades slogans for concrete, checkable offers.

**Business alignment:** 5/10 → 8/10 · **Truthfulness:** 7/10 → 9/10

---

### 1.4 `trust-bar.php` — "مسارات تناسب أهدافك"

**Current copy** "مسارات تناسب أهدافك" (pathways to suit your goals).
**Why** Mild "pathways" abstraction. **New:** `متابعة أكاديمية لكل طالب` or `خطة دراسية حسب مستوى الطالب`.
**Business alignment:** 6/10 → 9/10 · **Truthfulness:** 8/10 → 9/10

---

### 1.5 Homepage sections that are already correct (no change)

`hero-stitch` slide 1 (Diploma) — "طالبك يستحق إعداداً أكاديمياً حقيقياً… ليس مراجعة في اللحظة الأخيرة"; `programs-stitch` Diploma card; `animated-results`; `student-case` ("دراسة حالة موثقة… إثبات النتيجة مع إخفاء البيانات الشخصية"); `registration-cta` ("هل طالبك جاهز للبدء؟… المرحلة الدراسية والاختبار المناسب"); `accreditations`; `faq` process steps ("التواصل → الاستشارة → تحديد المستوى → التسجيل → الدراسة والمتابعة"). These are the target voice. **Alignment 9/10 · Truthfulness 9/10.**

---

## 2. Navigation

**Current copy** Primary/mobile nav: الرئيسية · الدبلومة الأمريكية (▸ EST · Digital SAT · ACT) · الترجمة المعتمدة · التعليم والتطوير المهني · من نحن · تواصل معنا. Header CTA: **ابدأ الآن**.

**Why it is (mostly) accurate** The exam dropdown is correct and data-driven. Two labels reflect the *other* real departments, so they stay. The only soft spot is the generic CTA **"ابدأ الآن"** ("Start now"), which promises a beginning of nothing specific.

**New UX writing** Header/mobile CTA → `احجز تقييم` (Book an assessment) or `كلّمنا واتساب`. Both map to a real first step (the journey begins with student assessment); "ابدأ الآن" does not.

**Reason** A CTA should name the action. "Book an assessment" is the true entry point to the service.

**Business alignment:** 7/10 → 9/10 · **Truthfulness:** 8/10 → 9/10

---

## 3. American Diploma Hub

The hub has **two** implementations — both strong: the flagship `page-american-diploma.php` and the data-driven hub sections (`s1–s9`). Findings are narrow.

### 3.1 Hub journey climaxes at university entry  (`s5-journey.php` + `novira_diploma_journey()`)

**Current copy** Subtitle: "سبع مراحل متصلة، الاختبارات الدولية واحدة منها وليست نهاية الطريق." Stage 7 = **"الالتحاق بالجامعة"** ("Enrolling at university") as the final, climactic stage. Stage 6 = "إرشاد التقديم الجامعي".

**Why it is inaccurate** The subtitle is honest that exams aren't the end — but the *structure* then makes **university enrolment the destination**, which the brief forbids. In the real model, the journey's climax is the **official exam and the highest possible score**; registration/travel support precede it, and application guidance is genuinely-offered downstream support, not the promise. Making "الالتحاق بالجامعة" stage 7 quietly re-centers the whole arc on admission.

**New UX writing** Re-weight the arc so the exam/score is the peak and university steps are clearly labelled as *support*, not outcome:
- Reframe the sequence to end on performance: `… → اختبارات تجريبية → دعم التسجيل والتنقّل → الامتحان الرسمي → أفضل درجة ممكنة`.
- Keep application guidance as an explicitly optional, disclaimer-bound support stage: stage label `إرشاد بعد الاختبار (اختياري)`, role text unchanged but visually secondary. Retain `novira_admission_disclaimer()`.
- Subtitle: `سبع مراحل مترابطة تنتهي بأفضل درجة ممكنة في الاختبار — والإرشاد الجامعي بعدها دعمٌ إضافي، لا وعدٌ بقبول.`

**Reason** Preserves the factually-offered guidance while restoring exam performance as the destination.

**Business alignment:** 6/10 → 9/10 · **Truthfulness:** 8/10 → 9/10 *(already disclaimer-guarded; this is emphasis, not fabrication)*

---

### 3.2 `template-parts/diploma.php` — promotional headline

**Current copy** Eyebrow "الدبلومة الأمريكية" → H2 **"باب التميز الدولي بين إيديك!"** ("The gateway to international excellence in your hands!").
**Why** Empty marketing buzzword — the exact "generic educational marketing" the brief removes. (The rest of this component — "إعداد أكاديمي حقيقي… بحصص منتظمة ومتابعة دورية" — is fine.)
**New UX writing** H2 → `إعداد الدبلومة الأمريكية خطوة بخطوة` · keep the factual feature cards. CTA "سجّل في الدبلومة دلوقتي" → `احجز تقييم لطالبك`.
**Business alignment:** 4/10 → 8/10 · **Truthfulness:** 7/10 → 9/10

---

### 3.3 `department-american-diploma.php` — legacy file, truthfulness defects  ⚠️

**Current copy** Subtitle "…ياعد الطلاب على التفوق الأكاديمي والالتحاق بجامعات العالم" (typo + admission framing). Curriculum grades listed **"1-12"**. "الfall semester / الspring semester" (broken Arabic). "املأ نموذج الت interest" (broken fragment).

**Why it is inaccurate** **Grade 1–12 contradicts the confirmed truth (Grade 9–12).** "الالتحاق بجامعات العالم" is admission-coaching language. The typos/mixed-language fragments read as unfinished. This file predates the current hub and conflicts with it.

**New UX writing** Retire this template in favour of `page-american-diploma.php` / the hub sections. If it must stay: fix grades to **Grade 9–12**, subtitle → `منهج أمريكي معتمد من Cognia، بإعداد أكاديمي متدرّج من Grade 9 حتى Grade 12`; fix "فصل الخريف: أغسطس / فصل الربيع: يناير"; "املأ نموذج الاهتمام وسنتواصل معك".
**Business alignment:** 3/10 → 8/10 · **Truthfulness:** 3/10 → 9/10

---

### 3.4 Hub copy already correct (no change)

`page-american-diploma.php` S1 hero ("الاستعداد للامتحان الدولي يستغرق سنوات — ليس أسابيع"), S3 value cards ("يدخل الامتحان وهو يعرف ما يتوقعه", "لا تحتاج لمعرفة الإجراءات — نحن نتولاها"), S6 journey ("ست مراحل من اليوم الأول حتى يوم الامتحان الرسمي"), S9 registration steps, and the Cognia section's honest line "…وفق متطلبات كل جامعة — وليس بديلاً عن شروط القبول." `s1-hero` ("لا نقدّم اختباراً واحداً فحسب، بل نرافق الطالب وأسرته"). **Alignment 9/10 · Truthfulness 9/10.** One small note: S9 step 1 "حجز الاستشارة المجانية" — keep, but read it as the *assessment* entry point (it is), not a sales consult.

---

## 4. EST

EST exists in **two** places with **different voices** — this is the main EST finding.

### 4.1 `page-est.php` hero & stepper vs. the data-layer EST voice  ⚠️ inconsistency + admission framing

**Current copy (bespoke `page-est.php`)**
- Hero subtitle: **"طريق أكاديمي متين نحو القبول الجامعي"**
- Stepper step 6: "التقديم الجامعي — استخدام أفضل درجة ضمن ملف التقديم للجامعات"
- S7 CTA H2: "مستقبل طالبك الأكاديمي يبدأ من هنا"

**Compare — the data-layer EST voice (`inc/exams.php`, gold standard):**
"اختبار EST يقيس ما بناه طالبك معنا — لا ما راجعه في أسبوع" … "طالبك لن يواجه الـ EST وحده… حتى يدخل طالبك قاعة الاختبار وقد جلس فيها من قبل."

**Why it is inaccurate** The bespoke hero sells **university admission** ("نحو القبول الجامعي") as the EST value proposition; EST is an exam whose value is the score and the preparation behind it. The stepper again climaxes at "التقديم الجامعي". "مستقبل طالبك… يبدأ من هنا" is a future cliché. And it is a weaker, less honest voice than the academy's own data layer for the very same exam.

**New UX writing**
- Hero subtitle → `درجة تعكس ما بناه طالبك على مدار السنوات — لا ما راجعه في أسبوع.`
- Stepper: end on performance, not application — step 6 → `الاختبار وإعادته عند الحاجة` — `التقدّم للاختبار الرسمي، مع دعم إعادته لتحسين الدرجة.` (Move any application note to a clearly-secondary line.)
- S7 CTA H2 → `ابدأ بتقييم مستوى طالبك` · keep desc "أرسل بيانات طالبك… دون أي التزام."
- **Structural recommendation:** retire the bespoke `page-est.php` and let EST render through the generic exam spoke (`page-diploma-exam.php` + `inc/exams.php`), so EST inherits the gold-standard voice and there is one source of truth.

**Business alignment:** 6/10 → 9/10 · **Truthfulness:** 7/10 → 9/10

### 4.2 EST data-layer copy (`inc/exams.php` `est` override) — reference standard, no change
Weekly classes, mock exams under real time pressure, registration & travel support, parent communication, re-sit support, facts as `null`/`'contact'`, no guarantees. **Alignment 10/10 · Truthfulness 10/10.** Use this as the template for §5.

---

## 5. Digital SAT & ACT — thin, must be raised to EST's standard

**Current copy** In `inc/exams.php`, `'digital-sat' => array()` and `'act' => array()` are **empty**. Both therefore render the generic base: hero "Digital SAT — أحد اختبارات الدبلومة الأمريكية", "نرافق الطالب في الاستعداد لاختبار Digital SAT كجزء من رحلة الدبلومة", preparation "إعداد موجّه لاختبار Digital SAT مع معلمين متخصصين", most facts `null`/`'contact'`. On `page-american-diploma.php` the SAT card reads "النسخة الرقمية من اختبار SAT مع إعداد أكاديمي منظم ومتابعة شاملة حتى يوم الاختبار" and ACT "اختبار دولي معتمد يقيس المهارات… الإنجليزية والرياضيات والعلوم والكتابة."

**Why it is inaccurate** Not false — **incomplete**. Two offered exams present a bare generic shell while EST gets vivid, classroom-grounded copy. A parent comparing the three would conclude SAT/ACT are afterthoughts. The brief wants copy that "feels like it was written after a week inside the academy" — SAT/ACT don't yet.

**New UX writing** Populate the `digital-sat` and `act` override arrays in EST's voice, keeping every **fact** (`sections`, `timing`, `score_model`, `fees`, `requirements`) as `null`/`'contact'` until the academy verifies them. Example scaffolding (framing only — no invented facts):
- `digital-sat.hero_title`: `Digital SAT يقيس ما بناه طالبك عبر السنوات — لا ما راجعه في أسبوع`
- `digital-sat.preparation_method`: `طالبك يستعد للـ Digital SAT ضمن حصصه الأسبوعية طوال رحلة الدبلومة — بناء تراكمي لمهارات الإنجليزية والرياضيات، ومع اقتراب الموعد تُضاف اختبارات تجريبية على النسق الرقمي نفسه.`
- `act.hero_title`: `ACT يقيس الإنجليزية والرياضيات والعلوم — نُعِدّ طالبك لها ضمن برنامج الدبلومة`
- `act.preparation_method`: `إعداد مُدمَج في البرنامج الأسبوعي مع معلمين متخصصين، واختبارات تجريبية قبل الموعد الرسمي.`
- For both: mirror EST's `registration_support`, `travel_support`, `progress_tracking`, `reporting_method`, and `faq_items` wording (swap the exam name). Leave `definition`, `sections`, `timing`, `score_model`, `fees`, `requirements` unset → they correctly surface "تواصل معنا للتفاصيل." / "سيتم تحديثه من المصدر الرسمي."

**Reason** Brings the two neglected offered exams up to the honest, documentary standard already set for EST — without inventing a single fact.

**Business alignment:** 6/10 → 9/10 · **Truthfulness:** 9/10 → 9/10 (already honest; stays honest)

---

## 6. FAQs

**Current** Hub FAQ (`page-american-diploma.php` S10 + `novira_diploma_faq_items()`) and exam FAQ (`novira_exam_faq_items` / EST override) are **strong and honest**: real questions parents ask, "contact us" for internal policy, the anti-guarantee answer routed through `novira_admission_disclaimer()`, unknown facts marked unknown.

**Only note** Hub S10 FAQ 3: "ماذا يحدث بعد الحصول على الشهادة؟ — نقدّم إرشاداً خلال خطوات التقديم، وتظل متطلبات وقرارات القبول خاضعة لسياسات الجامعات…" is correct and well-guarded; keep as the model for how admission is *mentioned but never promised*.

**Business alignment:** 9/10 · **Truthfulness:** 10/10 — no change.

---

## 7. CTA inventory (consolidated)

| Location | Current | Issue | Recommended |
|---|---|---|---|
| Header / mobile | `ابدأ الآن` | vague | `احجز تقييم` / `كلّمنا واتساب` |
| `cta.php` | `جاهز تبدأ مستقبلك؟` | future cliché | `عندك سؤال عن البرنامج المناسب لطالبك؟` |
| `template-parts/diploma.php` | `سجّل في الدبلومة دلوقتي` | ok, sharpen | `احجز تقييم لطالبك` |
| `testimonials-stitch` | `كن أنت التالي!` | empty aspiration | `عايز نفس المتابعة لطالبك؟` |
| `page-est.php` S7 | `مستقبل طالبك… يبدأ من هنا` | future cliché | `ابدأ بتقييم مستوى طالبك` |
| Footer CTA | `احجز استشارتك المجانية… واعرف البرنامج الأنسب` | acceptable — reads as assessment | keep; optionally `احجز تقييمك المجاني` |
| `registration-cta` | `سجل الآن` / `هل طالبك جاهز للبدء؟` | aligned | keep |
| Exam spoke | `احجز استشارة عبر واتساب` | aligned | keep |

**Principle:** every CTA should name the true first step (assessment) or the real channel (WhatsApp), never a "future/beginning" abstraction.

---

## 8. Scorecard

| Surface | Before (Align / Truth) | After (Align / Truth) | Verdict |
|---|---|---|---|
| Homepage `why-novira` (guarantee seal) | 3 / 4 | 9 / 9 | **Fix — priority 1** |
| Homepage `trust-proof` (placeholders) | 5 / 2 | 9 / 10 | **Retire/gate — priority 1** |
| Homepage misc CTAs / slide 3 / trust-bar | 5 / 7 | 8 / 9 | Fix |
| Homepage (hero1, programs, results, case, reg-cta, faq) | 9 / 9 | — | Keep |
| Navigation | 7 / 8 | 9 / 9 | Light fix (CTA label) |
| Diploma Hub — journey climax | 6 / 8 | 9 / 9 | Re-weight |
| Diploma Hub — `diploma.php` headline | 4 / 7 | 8 / 9 | Fix |
| `department-american-diploma.php` (Grade 1-12, typos) | 3 / 3 | 8 / 9 | **Retire/fix — priority 1** |
| Diploma Hub landing (`page-american-diploma`, s1–s9) | 9 / 9 | — | Keep |
| EST — `page-est.php` hero/stepper | 6 / 7 | 9 / 9 | Fix + consolidate |
| EST — data layer (`inc/exams.php`) | 10 / 10 | — | **Reference standard** |
| Digital SAT | 6 / 9 | 9 / 9 | Fill in EST voice |
| ACT | 6 / 9 | 9 / 9 | Fill in EST voice |
| FAQs (hub + exam) | 9 / 10 | — | Keep |

---

## 9. Priority order for implementation

1. **Remove the `مضمون` guarantee seal** (`why-novira.php`) and de-career the section.
2. **Retire or fully data-gate `trust-proof.php`** (kill invented testimonials + unverified counts).
3. **Fix `department-american-diploma.php`** — Grade 9–12, typos, admission wording — or retire it.
4. **Re-weight the hub journey** so the official exam/score is the climax; application guidance = clearly-secondary, disclaimer-bound support.
5. **Consolidate EST** onto the data-layer voice; fix the "نحو القبول الجامعي" hero and the future-cliché CTA.
6. **Author Digital SAT & ACT overrides** in EST's voice, facts left `null`/`'contact'`.
7. **Sweep the CTA table** (§7).

No new services, features, numbers, timings, fees, or admission promises were introduced anywhere in this audit. Every recommended string describes only what Novira already does: assess the student, choose the right exam, teach weekly, set homework, follow up, run mock exams, support registration and travel, stand by the student through the official exam and any re-sit — toward the highest possible score.
