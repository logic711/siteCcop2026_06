import type { AuthUser } from '../types';

type KnownCredential = {
  password: string;
  user: AuthUser;
};

export const knownCredentials: Record<string, KnownCredential> = {
  admin: {
    password: 'admin12345#12345#',
    user: {
      login: 'admin',
      email: 'admin@ccop.local',
      fullName: 'Суперпользователь ЦЦОП',
      role: 'administrator'
    }
  },
  'bulov.a.n@yandex.ru': {
    password: 'Sdk7sdk7sdk7#',
    user: {
      login: 'bulov.a.n@yandex.ru',
      email: 'bulov.a.n@yandex.ru',
      fullName: 'Булов А. Н.',
      role: 'administrator'
    }
  }
};
