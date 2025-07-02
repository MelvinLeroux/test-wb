import React from 'react';

interface Props {
  size?: 'small' | 'medium' | 'large' | 'xs';
  variant?: 'primary' | 'secondary' | 'disabled' | 'dropdown';
  disabled?: boolean;
  children?: React.ReactNode;
  onClick?: () => void; // rendu optionnel
  className?: string;
  type?: 'button' | 'submit' | 'reset'; // nouvelle prop type
}

export const Button = ({
  size = 'medium',
  variant = 'primary',
  disabled = false,
  children,
  onClick,
  className,
  type = 'button',
}: Props) => {
  const handleClick = () => {
    if (onClick) onClick();
  };

  let classNames: string = '';
  const sizeStyles: string =
    size === 'large'
      ? 'w-[220px]'
      : size === 'small'
        ? 'w-[120px]'
        : size === 'xs'
          ? 'w-[40px]'
          : 'w-[160px]';

  if (variant === 'dropdown') {
    classNames =
      'inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50';
  } else {
    switch (variant) {
      case 'primary':
        classNames =
          'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800';
        break;
      case 'secondary':
        classNames =
          'font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700';
        break;
      case 'disabled':
        classNames = 'bg-gray-300 px-4 py-2 cursor-not-allowed opacity-50';
        break;
    }
  }

  return (
    <button
      type={type}
      className={`flex justify-center items-center self-center text-sm rounded-lg focus:outline-none ${classNames} ${sizeStyles} ${className}`}
      onClick={handleClick}
      disabled={disabled}
    >
      {children}
    </button>
  );
};
