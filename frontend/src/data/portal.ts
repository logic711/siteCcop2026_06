import type { PageCard, PortalPageSlug, UserRole } from '../types';

export const headerPages: PageCard[] = [
  {
    slug: 'about',
    title: 'О портале',
    description: 'Описание задач Центра цифровой оптимизации процессов и форматов взаимодействия.',
    audience: 'Сотрудники, преподаватели, администраторы.',
    moderatorRole: 'moderator_about'
  },
  {
    slug: 'helpdesk',
    title: 'Helpdesk РИУ',
    description: 'Единое окно для обращений, статусов заявок и эскалаций.',
    audience: 'Все пользователи портала.',
    moderatorRole: 'moderator_helpdesk'
  },
  {
    slug: 'services',
    title: 'Сервисы ЦЦОП',
    description: 'Каталог цифровых сервисов, доступов и типовых сценариев поддержки.',
    audience: 'Преподаватели, сотрудники, администраторы.',
    moderatorRole: 'moderator_services'
  },
  {
    slug: 'guides',
    title: 'Инструкции',
    description: 'Подборка регламентов, инструкций и материалов для самостоятельной работы.',
    audience: 'Все пользователи портала.',
    moderatorRole: 'moderator_guides'
  },
  {
    slug: 'booking',
    title: 'Бронирование аудиторий для ВКС',
    description: 'Расписание переговорных, регламент резервирования и правила проведения ВКС.',
    audience: 'Сотрудники и организаторы мероприятий.',
    moderatorRole: 'moderator_booking'
  },
  {
    slug: 'life',
    title: 'Жизнь РИУ',
    description: 'Новости, события, объявления и голосования внутри института.',
    audience: 'Сообщество РИУ.',
    moderatorRole: 'moderator_life'
  }
];

export const footerPages: PageCard[] = [
  {
    slug: 'security',
    title: 'Политика безопасности',
    description: 'Требования по безопасности данных, доступам и работе с цифровыми системами.',
    audience: 'Все пользователи портала.',
    moderatorRole: 'moderator_security'
  },
  {
    slug: 'support',
    title: 'Техническая поддержка',
    description: 'Контакты техподдержки, SLA и базовые сценарии решения инцидентов.',
    audience: 'Все пользователи портала.',
    moderatorRole: 'moderator_support'
  }
];

export const allPages = [...headerPages, ...footerPages];

export const pageMap = Object.fromEntries(allPages.map((page) => [page.slug, page])) as Record<
  PortalPageSlug,
  PageCard
>;

export const moderatorRoleLabels: Record<UserRole, string> = {
  administrator: 'Администратор',
  user: 'Пользователь',
  moderator_about: 'Модератор страницы "О портале"',
  moderator_helpdesk: 'Модератор страницы "Helpdesk РИУ"',
  moderator_services: 'Модератор страницы "Сервисы ЦЦОП"',
  moderator_guides: 'Модератор страницы "Инструкции"',
  moderator_booking: 'Модератор страницы "Бронирование аудиторий для ВКС"',
  moderator_life: 'Модератор страницы "Жизнь РИУ"',
  moderator_security: 'Модератор страницы "Политика безопасности"',
  moderator_support: 'Модератор страницы "Техническая поддержка"'
};

export const demoRoleResolver = (email: string): UserRole => {
  const normalized = email.toLowerCase();

  if (normalized.startsWith('admin')) {
    return 'administrator';
  }

  if (normalized.includes('about')) {
    return 'moderator_about';
  }

  if (normalized.includes('helpdesk')) {
    return 'moderator_helpdesk';
  }

  if (normalized.includes('service')) {
    return 'moderator_services';
  }

  if (normalized.includes('guide') || normalized.includes('instr')) {
    return 'moderator_guides';
  }

  if (normalized.includes('booking') || normalized.includes('vks')) {
    return 'moderator_booking';
  }

  if (normalized.includes('life') || normalized.includes('news')) {
    return 'moderator_life';
  }

  if (normalized.includes('security')) {
    return 'moderator_security';
  }

  if (normalized.includes('support')) {
    return 'moderator_support';
  }

  return 'user';
};
