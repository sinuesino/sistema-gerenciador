'use client';

import { AppBar, Toolbar, Typography, CssBaseline } from '@mui/material';

export default function Navbar() {
  return (
    <>
      <CssBaseline />
      <AppBar position="static">
        <Toolbar>
          <Typography variant="h6" component="div">
            Minha Navbar
          </Typography>
        </Toolbar>
      </AppBar>
    </>
  );
}
