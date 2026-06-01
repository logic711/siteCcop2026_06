import { reactive } from 'vue';
import type { AuthUser } from './types';
import { demoRoleResolver } from './data/portal';
import { knownCredentials } from './data/authUsers';

const STORAGE_KEY = 'ccop-auth-user';

const storedUser = localStorage.getItem(STORAGE_KEY);

export const authState = reactive<{
  user: AuthUser | null;
}>({
  user: storedUser ? (JSON.parse(storedUser) as AuthUser) : null
});

export const resolveAuthUser = (identifier: string, password: string): AuthUser | null => {
  const normalized = identifier.trim();
  const credential = knownCredentials[normalized];

  if (credential) {
    return credential.password === password ? credential.user : null;
  }

  return {
    login: normalized,
    email: normalized,
    fullName: `Пользователь ${normalized.split('@')[0] || normalized || 'ЦЦОП'}`,
    role: demoRoleResolver(normalized)
  };
};

export const login = (user: AuthUser, remember: boolean) => {
  authState.user = user;

  if (remember) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(authState.user));
  } else {
    localStorage.removeItem(STORAGE_KEY);
  }
};

export const logout = () => {
  authState.user = null;
  localStorage.removeItem(STORAGE_KEY);
};
