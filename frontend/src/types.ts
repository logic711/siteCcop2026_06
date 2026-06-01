export type PortalPageSlug =
  | 'about'
  | 'helpdesk'
  | 'services'
  | 'guides'
  | 'booking'
  | 'life'
  | 'security'
  | 'support';

export type UserRole =
  | 'administrator'
  | 'user'
  | 'moderator_about'
  | 'moderator_helpdesk'
  | 'moderator_services'
  | 'moderator_guides'
  | 'moderator_booking'
  | 'moderator_life'
  | 'moderator_security'
  | 'moderator_support';

export interface PageCard {
  slug: PortalPageSlug;
  title: string;
  description: string;
  audience: string;
  moderatorRole?: UserRole;
}

export interface AuthUser {
  login: string;
  email: string;
  fullName: string;
  role: UserRole;
}
