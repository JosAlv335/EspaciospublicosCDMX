// supabaseClient.js

import { createClient } from '@supabase/supabase-js';

const supabaseUrl = 'tu-url-de-supabase';
const supabaseAnonKey = 'tu-anon-key';

export const supabase = createClient(supabaseUrl, supabaseAnonKey);
