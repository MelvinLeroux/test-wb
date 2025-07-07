import { createUser } from '@/api/register';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { UserLogin } from '@/types';
import React from 'react';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
interface Signup1Props {
  heading?: string;
  signupText?: string;
  googleText?: string;
  loginText?: string;
  loginUrl?: string;
}

const Signup = ({
  heading,
  signupText = 'Create an account',
  loginText = 'Already have an account?',
  loginUrl = 'login',
}: Signup1Props) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();
  const [currentUser, setCurrentUser] = useState<UserLogin | undefined>(
    undefined
  );
  const create = async (user: UserLogin): Promise<void> => {
    try {
      await createUser(user);
      setCurrentUser(user);
      navigate('/');
    } catch (err) {
      console.error(err, 'Erreur lors de la connexion');
    }
  };
  const handleSubmit = async (event: React.MouseEvent<HTMLButtonElement>) => {
    event.preventDefault();
    const user: UserLogin = {
      email,
      password,
    };
    await create(user);
  };

  return (
    <section className='h-screen'>
      <div className='flex h-full items-center justify-center'>
        <div className='border-muted bg-background flex w-full max-w-sm flex-col items-center gap-y-8 rounded-md border px-6 py-12 shadow-md'>
          <div className='flex flex-col items-center gap-y-2'>
            {heading && <h1 className='text-3xl font-semibold'>{heading}</h1>}
          </div>
          <div className='flex w-full flex-col gap-8'>
            <div className='flex flex-col gap-4'>
              <div className='flex flex-col gap-2'>
                <Input
                  type='email'
                  placeholder='Email'
                  value={email}
                  onChange={e => setEmail(e.target.value)}
                  required
                />
              </div>
              <div className='flex flex-col gap-2'>
                <Input
                  type='password'
                  placeholder='Password'
                  value={password}
                  onChange={e => setPassword(e.target.value)}
                  required
                />
              </div>
              <div className='flex flex-col gap-4'>
                <Button
                  onClick={handleSubmit}
                  type='submit'
                  className='mt-2 w-full'
                >
                  {signupText}
                </Button>
              </div>
            </div>
          </div>
          <div className='text-muted-foreground flex justify-center gap-1 text-sm'>
            <p>{loginText}</p>
            <a
              href={loginUrl}
              className='text-primary font-medium hover:underline'
            >
              Login
            </a>
          </div>
        </div>
      </div>
    </section>
  );
};

export { Signup };
